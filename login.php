<?php
/* Set oracle user login and password info */
$dbuser = "GÖBI";
$dbpass = "123456";
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
  
  $conn = oci_connect($dbuser, $dbpass, $tns,'UTF8') or die();

if (!$conn)  {
    echo "An error occurred connecting to the database"; 
    exit; 
}

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