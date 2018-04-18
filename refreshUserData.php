<?php
	include_once 'queries.php';

	$conn = connect();
	
	$sql_fullName="SELECT NEV FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$sql_accountNumber="SELECT BANKSZAMLASZAM FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$sql_accountMoney="SELECT EGYENLEG FROM SZEMELY,BANKSZAMLA WHERE SZEMELY.BANKSZAMLASZAM=BANKSZAMLA.BANKSZAMLASZAM AND FELHASZNALONEV = '$user'"; 
	$sql_email="SELECT EMAIL_CIM FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$sql_phoneNumber="SELECT TELEFONSZAM FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	
	
	$fullName_stmt=oci_parse($conn, $sql_fullName);
	$accountNumber_stmt=oci_parse($conn, $sql_accountNumber);
	$accountMoney_stmt=oci_parse($conn, $sql_accountMoney);
	$email_stmt=oci_parse($conn, $sql_email);
	$phoneNumber_stmt=oci_parse($conn, $sql_phoneNumber);
	
	oci_execute($fullName_stmt);
	oci_execute($accountNumber_stmt);
	oci_execute($accountMoney_stmt);
	oci_execute($email_stmt);
	oci_execute($phoneNumber_stmt);
	
	while ( $row = oci_fetch_array($fullName_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$fullName= $item;
		}	
	}
	while ( $row = oci_fetch_array($accountNumber_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$accountNumber= $item;
		}	
	}
	while ( $row = oci_fetch_array($accountMoney_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$accountMoney= $item;
		}	
	}
	while ( $row = oci_fetch_array($email_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$email= $item;
		}	
	}
	while ( $row = oci_fetch_array($phoneNumber_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$phoneNumber= $item;
		}	
	}
	
	
	session_start();
	$_SESSION["user"] = $user;
	$_SESSION["pass"] = $pass;
	$_SESSION["passConfirm"] = $pass;
	$_SESSION["fullName"] = $fullName;
	$_SESSION["accountNumber"] = $accountNumber;
	$_SESSION["accountMoney"] = $accountMoney;
	$_SESSION["email"] = $email;
	$_SESSION["phoneNumber"] = $phoneNumber;
	


?>