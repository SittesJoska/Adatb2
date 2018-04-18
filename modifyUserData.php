<?php
include_once 'queries.php';
include "menu.html";

$conn = connect();

$user=$_POST['username'];
$newPassword=$_POST['password'];
$newPasswordConfirm=$_POST['passwordConfirm'];
$newEmail=$_POST['email'];
$newPhoneNumber=$_POST['phoneNumber'];

if($newPassword!=$newPasswordConfirm){
	echo '<div class="div3"><p>A két jelszó nem egyezik meg...</p></div>';
	header('Refresh: 2; URL = userPage.php');
}
$sql_updatePassword = "UPDATE SZEMELY SET JELSZO='$newPassword' WHERE FELHASZNALONEV='$user'";   
$sql_updateEmail = "UPDATE SZEMELY SET EMAIL_CIM='$newEmail' WHERE FELHASZNALONEV='$user'";  
$sql_updatePhoneNumber = "UPDATE SZEMELY SET TELEFONSZAM='$newPhoneNumber' WHERE FELHASZNALONEV='$user'";  

$updatePassword_stmt = oci_parse($conn, $sql_updatePassword);
$updateEmail_stmt = oci_parse($conn, $sql_updateEmail);
$updatePhoneNumber_stmt = oci_parse($conn, $sql_updatePhoneNumber);

	
oci_execute($updateEmail_stmt);
oci_execute($updatePassword_stmt);
oci_execute($updatePhoneNumber_stmt);

session_start();
$user=$_SESSION["user"];
	
	
	$sql_password="SELECT JELSZO FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$password_stmt=oci_parse($conn, $sql_password);
	oci_execute($password_stmt);
	while ( $row = oci_fetch_array($password_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$password= $item;
		}	
	}
	$_SESSION['pass']=$password;
	
	$sql_email="SELECT EMAIL_CIM FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$email_stmt=oci_parse($conn, $sql_email);
	oci_execute($email_stmt);
	while ( $row = oci_fetch_array($email_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$email= $item;
		}	
	}
	$_SESSION['email']=$email;
	
	$sql_phoneNumber="SELECT TELEFONSZAM FROM SZEMELY WHERE FELHASZNALONEV = '$user'"; 
	$phoneNumber_stmt=oci_parse($conn, $sql_phoneNumber);
	oci_execute($phoneNumber_stmt);
	while ( $row = oci_fetch_array($phoneNumber_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$phoneNumber= $item;
		}	
	}
	$_SESSION['phoneNumber']=$phoneNumber;
		
	
	header('Refresh: 0; URL = userPage.php');
	die();

?>