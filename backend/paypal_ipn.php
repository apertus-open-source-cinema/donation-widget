<?php

function PaypalTime2Timestamp ($date){

	// PAYPAL DATE FORMAT IS HH:mm:ss Jan DD, YYYY PST
	// We want to convert that to Unixtime stamp, then do the timeshift from PST to EST

	$hours = substr($date, 0,2);
	$mins = substr($date, 3,2);
	$secs = substr($date, 6,2);
	$monthword = strtoupper(substr($date, 9,3));
	$monthnames =array('JAN'=>'01','FEB'=>'02','MAR'=>'03','APR'=>'04','MAY'=>'05','JUN'=>'06','JUL'=>'07','AUG'=>'08','SEP'=>'09','OCT'=>'10','NOV'=>'11','DEC'=>'12');
	$monthnum = $monthnames[$monthword];

	$day = substr($date, 13,2);
	$year = substr($date, 17,4);

	$phpdate = mktime($hours,$mins,$secs,$monthnum,$day,$year);

	// PAYPAL TIMESTAMPS ARE IN PST (or PDT). SO, THE PHPDATE WE JUST CALCULATED IS OFF BY SEVERAL HOURS.
	// TO FIND THE TIME IN EST(or EDT), WE RECALC THE DATE BY
	// 1. ADDING THE UNIX TIMESTAME TO THE EPOCH START
	// 2. add 9 hours for GMT+1 Timezone

	$phpdate = strtotime ("1 Jan 1970 + $phpdate seconds +9hours");
	$phpdate = date('Y-m-d H:i:s', $phpdate);
	return $phpdate;
}

require_once 'meekrodb.2.1.class.php';

// MYSQL DB
DB::$user 		= 'MYSQL-USERNAME';
DB::$password 	= 'MYSQL-PASSWORD';
DB::$dbName 	= 'MYSQL-DATABASENAME';


// intantiate the IPN listener
include('ipnlistener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = false;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}
$verified = true;
if ($verified) {
	$Status = "IPN";
	
	// convert paypal date format
	$date = PaypalTime2Timestamp($_POST['payment_date']);
	
	// extract data from custom values
	parse_str($_POST['custom'], $custom);
	$spread_string = $custom['divide_axiom'].",".$custom['divide_opencine'].",".$custom['divide_dictator'].",".$custom['divide_website'].",".$custom['divide_hollywood'].",".$custom['divide_misc'];
	$newsletteremail = $custom['email'];
	$nick = $custom['nick'];
	$donation_freq = $custom['donation_freq'];
	
	// check spread sum against total donation amount
	$spread_sum = $custom['divide_axiom'] + $custom['divide_opencine'] + $custom['divide_dictator'] + $custom['divide_website'] + $custom['divide_hollywood'] + $custom['divide_misc'];
	if ($_POST['mc_gross'] != $spread_sum) {
		// manipulation attempt or terrible bug -> sums dont match
		$Status = "IPN - manipulation suspected";
	}

	// Insert into DB
	DB::insert('donations', array(
		'status' => $Status,
		'email' => $_POST['payer_email'],
		'newsletter_email' => $newsletteremail,
		'donation_amount' => $_POST['mc_gross'],
		'donation_spread' => $spread_string,
		'donation_type' => $donation_freq,
		'payment_date' => $date, 
		'nick' => $nick, 
		'ipn_track_id' => $_POST['ipn_track_id'],
		'txn_id' => $_POST['txn_id'],
		'payer_id' => $_POST['payer_id'],
		'address_street' => $_POST['address_street'],
		'address_zip' => $_POST['address_zip'],
		'address_country_code' => $_POST['address_country_code'],
		'address_name' => $_POST['address_name'],
		'address_country' => $_POST['address_country'],
		'address_city' => $_POST['address_city'],
		'address_state' => $_POST['address_state'],
		'txn_type' => $_POST['txn_type'],
		'full_report' => $listener->getTextReport()
		));
		
	// send email notifications
	mail('mailaddress@mail.com', 'IPN success', $listener->getTextReport());
	mail('mailaddress@mail.com', 'we received a new donation!', "We received: ".$_POST['mc_gross']." € from: ".$nick);
} else {
    // manually investigate the invalid IPN
    mail('mailaddress@mail.com', 'Invalid IPN', $listener->getTextReport());
}

?>