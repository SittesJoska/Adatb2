<?php

include_once 'connection.php';

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql_login = "SELECT FELHASZNALONEV,JELSZO FROM SZEMELY WHERE FELHASZNALONEV = '$user' AND JELSZO = '$pass'"; 
//$sql_login = "SELECT FELHASZNALONEV,JELSZO FROM SZEMELY WHERE FELHASZNALONEV='bela' AND JELSZO='bela'"; 

$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

$exists = oci_fetch_array($login_stmt);

if($exists) {
	echo "Logged in";
} else {
	echo "Login failed";
}

?>