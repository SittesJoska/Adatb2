<?php
include_once 'queries.php';
include "menu.html";

$conn = connect();

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

?>