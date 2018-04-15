<?php
include_once 'connection.php';

$user = $_POST['username'];
$pass1 = $_POST['password'];
$pass2 = $_POST['passwordConfirm'];
$name = $_POST['name'];
$bank = $_POST['accountNumber'];
$email = $_POST['email'];
$telo = $_POST['phoneNumber'];

$sql_regist = "INSERT INTO SZEMELY VALUES('$user','$pass1','$name','$telo','$email','$bank')";   

$regist_stmt = oci_parse($conn, $sql_regist);

if(!$regist_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

if($pass1==$pass2) {
	oci_execute($regist_stmt);
	echo "Sikeres regisztráció!";
} else {
	echo "Oops! A jelszók nem egyeznek! Próbáld újra!";
}

/*$exists = oci_fetch_array($login_stmt);

if($exists) {
	echo "Logged in";
} else {
	echo "Login failed";
}*/

?>