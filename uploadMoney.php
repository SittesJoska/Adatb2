<?php
include_once 'connection.php';
include "menu.html";


$accountNumber = $_POST['accountNumber'];
$accountMoney = $_POST['accountMoney'];

$newMoney=$accountMoney+10000;
$sql_upload = "UPDATE BANKSZAMLA SET EGYENLEG=$newMoney WHERE $accountNumber=BANKSZAMLASZAM";   

$upload_stmt = oci_parse($conn, $sql_upload);

if(!$upload_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}
	
oci_execute($upload_stmt);
	session_start();
	$user=$_SESSION["user"];
	$sql_accountMoney="SELECT EGYENLEG FROM SZEMELY,BANKSZAMLA WHERE SZEMELY.BANKSZAMLASZAM=BANKSZAMLA.BANKSZAMLASZAM AND FELHASZNALONEV = '$user'"; 
	$accountMoney_stmt=oci_parse($conn, $sql_accountMoney);
	oci_execute($accountMoney_stmt);
	while ( $row = oci_fetch_array($accountMoney_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$accountMoney= $item;
		}	
	}
	$_SESSION['accountMoney']=$accountMoney;
	header('Refresh: 0; URL = userPage.php');
			die();
	

function csatlakozas() {
	
	$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
  
$conn = oci_connect('GÖBI', '123456', $tns,'UTF8') or die();
	
	return $conn;
	
}


?>