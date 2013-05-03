<?php
require_once 'meekrodb.2.1.class.php';

// MYSQL DB
DB::$user 		= 'MYSQL-USERNAME';
DB::$password 	= 'MYSQL-PASSWORD';
DB::$dbName 	= 'MYSQL-DATABASENAME';

if ((!empty($_POST['Donation_Amount'])) && (!empty($_SERVER['REMOTE_ADDR'])) && ($_SERVER['HTTP_REFERER'] == "http://apertus.org/donation/")) {
	//log donation to DB
	DB::insert('donations', array(
		'status' => "Form submitted",
		'newsletter_email' => $_POST['Email'],
		'donation_type' => $_POST['Donation_Type'],
		'donation_amount' => $_POST['Donation_Amount'],
		'IP' => $_SERVER['REMOTE_ADDR']
		));
}
?>