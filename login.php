<?php

include_once "queries.php";
include "menu.html";

$conn = connect();

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql_login = "SELECT FELHASZNALONEV,JELSZO FROM SZEMELY WHERE FELHASZNALONEV = '$user' AND JELSZO = '$pass'"; 

$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

$exists = oci_fetch_array($login_stmt);

if($exists && !isset($_SESSION["user"]) ) {
	
	include 'refreshUserData.php';
	
	
	echo '<div class="div3"><p>Sikeres bejelentkezés...</p></div>';
	header('Refresh: 2; URL = mainPage.php');
}
else if($exists && isset($_SESSION["user"])){
		echo '<div class="div3"><p>Már be vagy jelentkezve...</p></div>';
		header('Refresh: 2; URL = mainPage.php');
	}
 else {
	echo '<div class="div3"><p>Sikertelen bejelentkezés...</p></div>';
	header('Refresh: 2; URL = loginForm.php');
}


?>