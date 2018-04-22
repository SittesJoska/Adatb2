<?php

function connect() {
	$dbuser = "SinterJóska";
	$dbpass = "mk8h7a3";
	$dbname = "xe";

	$tns = "
	(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SID = xe)
		)
	  )";
	  
	  $conn = oci_connect($dbuser, $dbpass, $tns, 'UTF8') or die();

	if (!$conn)  {
		echo "An error occurred connecting to the database"; 
		exit; 
	}
	
	return $conn;
}

function getMenetrend($startdate) {
	
	$day = null;
	
	if(!($conn = connect())){
		return false;
	}
	
	$sql = "select to_char (date '".$startdate."', 'fmd') d from dual";
	
	$stmt = oci_parse($conn, $sql);
	
	oci_execute($stmt);
	
	$number = oci_fetch_row($stmt);
			
		if($number[0] == 2) {
			$day = "Hétfő";
		} else if($number[0] == 3) {
			$day = "Kedd";
		} else if($number[0] == 4) {
			$day = "Szerda";
		} else if($number[0] == 5) {
			$day = "Csütörtök";
		} else if($number[0] == 6) {
			$day = "Péntek";
		} else if($number[0] == 7) {
			$day = "Szombat";
		} else if($number[0] == 1) {
			$day = "Vasárnap";
		}
		
	return $day;
	
	
}
?>