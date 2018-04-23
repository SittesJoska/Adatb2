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

function getUtazasIdotartam($menetrendId) {
	if(!($conn = connect())){
		return false;
	}
	$menetidoSql = "SELECT Menetido FROM UTAZASIDOTARTAM WHERE TAV = (SELECT TAV FROM MENETREND WHERE Menetrend_id = '".$menetrendId."')";
	$menetStmt = oci_parse($conn, $menetidoSql);
	oci_execute($menetStmt);
	$idotartam = oci_fetch_row($menetStmt);
	
	return $idotartam[0];
}

function getIndulas($menetrendId) {
	if(!($conn = connect())){
		return false;
	}
	$oraSql = "SELECT ORA, PERC FROM MENETREND WHERE Menetrend_id = '".$menetrendId."'";
	$oraStmt = oci_parse($conn, $oraSql);
	oci_execute($oraStmt);
	$ido = oci_fetch_row($oraStmt);
	
	return $ido;
}

function getRepulo($selectedId) {
	if(!($conn = connect())){
		return false;
	}
	$tipusSql = "SELECT REPULO_TIPUS FROM MENETREND WHERE MENETREND_ID = '".$selectedId."'";
	$tipusStmt = oci_parse($conn, $tipusSql);
	oci_execute($tipusStmt);
	$tipus = oci_fetch_row($tipusStmt);
													
	return $tipus[0];
}

function getLegitarsasag($selectedId) {
	if(!($conn = connect())){
		return false;
	}
	$legitarsasag = "SELECT LEGITARSASAG_NEV FROM MENETREND WHERE MENETREND_ID = '".$selectedId."'";
	$stmtLegitarsasag = oci_parse($conn, $legitarsasag);
	oci_execute($stmtLegitarsasag);
	$legitarsasagNev = oci_fetch_row($stmtLegitarsasag);
													
	return $legitarsasagNev[0];
}
?>