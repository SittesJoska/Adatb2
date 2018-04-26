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

function insertFoglalas($felnott, $gyerek, $etkezes, $seat, $startDate, $jaratId) {
	if(!($conn = connect())){
		return false;
	}
	
	$sql_max_fog_id = "SELECT MAX(FOGLALAS_ID) FROM FOGLALAS";
	$stmt_max_fog_id = oci_parse($conn, $sql_max_fog_id);
	oci_execute($stmt_max_fog_id);
	
	$max_fog_id = oci_fetch_row($stmt_max_fog_id);
	$maximum = $max_fog_id[0]+1;
	
	$sql_insert_foglalas = "INSERT INTO FOGLALAS VALUES('$maximum','$felnott', '$gyerek', '$etkezes', '$seat',TO_DATE('$startDate','yyyy-mm-dd'), '$jaratId')";
	$stmt_insert_foglalas = oci_parse($conn, $sql_insert_foglalas);
	oci_execute($stmt_insert_foglalas);
	
	$user = $_SESSION['user'];
	$sql_insert_szemely_foglalasai = "INSERT INTO SZEMELYFOGLALASAI VALUES('$user','$maximum')";
	$stmt_insert_szemely_foglalasai = oci_parse($conn, $sql_insert_szemely_foglalasai);
	oci_execute($stmt_insert_szemely_foglalasai);
}

function deleteAccount() {
	if(!($conn = connect())){
		return false;
	}
	
	$user = $_SESSION["user"];
	
	$felhasznaloSql = "SELECT FOGLALAS_ID FROM SZEMELYFOGLALASAI WHERE FELHASZNALONEV = '".$user."'";
	$felhasznaloStmt = oci_parse($conn, $felhasznaloSql);
	oci_execute($felhasznaloStmt);
	
	while($foglalasRow = oci_fetch_array($felhasznaloStmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($foglalasRow as $foglalas_id) {
			
			$deleteSql = "DELETE FROM SZEMELYFOGLALASAI WHERE FELHASZNALONEV = '".$user."'";
			$deleteStmt = oci_parse($conn, $deleteSql);
			oci_execute($deleteStmt);
			
			$deleteFoglalasSql = "DELETE FROM FOGLALAS WHERE FOGLALAS_ID = '".$foglalas_id."'";
			$deleteFoglalasStmt = oci_parse($conn, $deleteFoglalasSql);
			oci_execute($deleteFoglalasStmt);
		}
	}
	
	$bankszamlaSql = "SELECT BANKSZAMLA FROM SZEMELY WHERE FELHASZNALONEV = '".$user."'";
	$bankszamlaStmt = oci_parse($conn, $bankszamlaSql);
	oci_execute($bankszamlaStmt);
	$bankszamlaRow = oci_fetch_row($bankszamlaStmt);
	$bankszamlaszam = $bankszamlaRow[0];
	
	$deleteSzamlaSql = "DELETE FROM BANKSZAMLA WHERE BANKSZAMLASZAM = '".$bankszamlaszam."'";
	$deleteSzamlaStmt = oci_parse($conn, $deleteSzamlaSql);
	oci_execute($deleteSzamlaStmt);
	
	$deleteAccountSql = "DELETE FROM SZEMELY WHERE FELHASZNALONEV = '".$user."'";
	$deleteAccountStmt = oci_parse($conn, $deleteAccountSql);
	oci_execute($deleteAccountStmt);
}

function deleteAccountByAdmin($selectedAccount) {
	if(!($conn = connect())){
		return false;
	}
	
	$felhasznaloSql = "SELECT FOGLALAS_ID FROM SZEMELYFOGLALASAI WHERE FELHASZNALONEV = '".$selectedAccount."'";
	$felhasznaloStmt = oci_parse($conn, $felhasznaloSql);
	oci_execute($felhasznaloStmt);
	
	while($foglalasRow = oci_fetch_array($felhasznaloStmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($foglalasRow as $foglalas_id) {
			
			$deleteSql = "DELETE FROM SZEMELYFOGLALASAI WHERE FELHASZNALONEV = '".$selectedAccount."'";
			$deleteStmt = oci_parse($conn, $deleteSql);
			oci_execute($deleteStmt);
			
			$deleteFoglalasSql = "DELETE FROM FOGLALAS WHERE FOGLALAS_ID = '".$foglalas_id."'";
			$deleteFoglalasStmt = oci_parse($conn, $deleteFoglalasSql);
			oci_execute($deleteFoglalasStmt);
		}
	}
	
	$bankszamlaSql = "SELECT BANKSZAMLASZAM FROM SZEMELY WHERE FELHASZNALONEV = '".$selectedAccount."'";
	$bankszamlaStmt = oci_parse($conn, $bankszamlaSql);
	oci_execute($bankszamlaStmt);
	$bankszamlaRow = oci_fetch_row($bankszamlaStmt);
	$bankszamlaszam = $bankszamlaRow[0];
	
	$deleteSzamlaSql = "DELETE FROM BANKSZAMLA WHERE BANKSZAMLASZAM = '".$bankszamlaszam."'";
	$deleteSzamlaStmt = oci_parse($conn, $deleteSzamlaSql);
	oci_execute($deleteSzamlaStmt);
	
	$deleteAccountSql = "DELETE FROM SZEMELY WHERE FELHASZNALONEV = '".$selectedAccount."'";
	$deleteAccountStmt = oci_parse($conn, $deleteAccountSql);
	oci_execute($deleteAccountStmt);
}
?>