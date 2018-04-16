<?php

function connect(){
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
	} else {
		return $conn;
	}
}

function getMenetrend($startDate){
		
	if(!($conn = connect())){
		return false;
	}
	
	$sql = "select to_char (date '".$startDate."', 'D') day from dual";
	
	$stmt = oci_parse($conn, $sql);
		
	oci_execute($stmt);
		
	$row = oci_fetch_row($stmt);
	
	$day = null;
	
	if($row[0] == 2) {
		$day = "Hétfő";
	} else if($row[0] == 3) {
		$day = "Kedd";
	} else if($row[0] == 4) {
		$day = "Szerda";
	} else if($row[0] == 5) {
		$day = "Csütörtök";
	} else if($row[0] == 6) {
		$day = "Péntek";
	} else if($row[0] == 7) {
		$day = "Szombat";
	} else if($row[0] == 1) {
		$day = "Vasárnap";
	}
	
	return $day;
	
}
?>