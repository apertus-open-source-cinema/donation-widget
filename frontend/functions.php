<?php
require_once 'meekrodb.2.1.class.php';

// MYSQL DB
DB::$user 		= 'MYSQL-USERNAME';
DB::$password 	= 'MYSQL-PASSWORD';
DB::$dbName 	= 'MYSQL-DATABASENAME';

function GetNumberOfDonations() {
	return DB::queryFirstField("SELECT COUNT(*) FROM donations WHERE status=%s", "IPN");
}

function GetTotalDonations() {
	return number_format(DB::queryFirstField("SELECT SUM(donation_amount) FROM donations WHERE status=%s", "IPN"), 2);
}

function GetTotalDonationsSubproject($subproject, $currencyformat = true) {
	$sum = 0;
	$results = DB::query("SELECT donation_amount, donation_spread FROM donations WHERE status=%s", "IPN");
	foreach ($results as $row) {
		$subprojects = explode(",", $row['donation_spread']);
		if (array_key_exists($subproject, $subprojects)) {
			$sum += $subprojects[$subproject];
		}
	}
	if ($currencyformat) {
		return number_format($sum, 2);
	} else {
		return $sum;
	}
}

function GetDonators($minidonation, $maxdonation ) {
	$results = DB::query("SELECT nick, nick_url, donation_amount FROM donations WHERE status=%s AND donation_amount>=%i AND donation_amount<=%i ORDER BY donation_amount", "IPN", $minidonation, $maxdonation);

	return $results;
}

function GetAllDonators($orderby = "payment_date") {
	$whitelist = array('id', 'donation_amount', 'payment_date', 'email', 'address_name', 'address_name', 'address_street', 'address_zip', 'address_city', 'address_state', 'address_country', 'payment_date');

	if (in_array($orderby, $whitelist)) {
		$order = $orderby;
	} else {
		$order = "payment_date";
	}

	$results = DB::query("SELECT id, nick, nick_url, donation_amount, address_name, email, address_street, address_zip, address_country_code, address_country, address_city, address_state, payment_date
	FROM donations WHERE status=%s ORDER BY %l", "IPN", $order);

	return $results;
}
function ReplaceTwitter($nick) {
	if (substr($nick, 0 , 1) == "@") {
		return "<a target=\"_blank\" href=\"http://www.twitter.com/".substr($nick, 1)."\">".$nick."</a>";
	} else {
		return $nick;
	}
} 
?>