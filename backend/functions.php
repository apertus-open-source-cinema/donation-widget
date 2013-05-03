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
	return DB::queryFirstField("SELECT SUM(donation_amount) FROM donations WHERE status=%s", "IPN");
}

function GetTotalDonationsSubproject($subproject) {
	$sum = 0;
	$results = DB::query("SELECT donation_amount, donation_spread FROM donations WHERE status=%s", "IPN");
	foreach ($results as $row) {
		$subprojects = explode(",", $row['donation_spread']);
		if (array_key_exists($subproject, $subprojects)) {
			$sum += $subprojects[$subproject] * $row['donation_amount'];
		}
	}
	return $sum;
}

function GetDonators($minidonation, $maxdonation ) {
	$results = DB::query("SELECT nick, nick_url, donation_amount FROM donations WHERE status=%s AND donation_amount>=%i AND donation_amount<=%i ORDER BY donation_amount", "IPN", $minidonation, $maxdonation);

	return $results;
}
?>