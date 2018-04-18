<?php
include_once 'queries.php';
include "menu.html";

$conn = connect();

$user = $_POST['username'];
$pass1 = $_POST['password'];
$pass2 = $_POST['passwordConfirm'];
$name = $_POST['name'];
$bank = $_POST['accountNumber'];
$email = $_POST['email'];
$telo = $_POST['phoneNumber'];

$sql_regist = "INSERT INTO SZEMELY VALUES('$user','$pass1','$name','$telo','$email','$bank')"; 
$sql_createBankAccount="INSERT INTO BANKSZAMLA VALUES('$bank','200000')";  

$regist_stmt = oci_parse($conn, $sql_regist);
$create_stmt = oci_parse($conn, $sql_createBankAccount);


if(!$regist_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}
if(!$create_stmt){
	echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}
if($pass1!=$pass2) {
	echo '<div class="div3"><p>A két jelszó nem egyezik!</p><a href="registForm.php"><input type="submit" value="Vissza" name="goBack" class="buttonType"/></a></div>';
	}else if(!letezo_felhasznalo($user)){
			if(!letezo_bankszamla($bank)){ //ha még nem létezik a bankszámla létrehozza, ha igen akkor ugyanazt a számlát több usernek is meg lehet adni
				oci_execute($create_stmt);
			}
				oci_execute($regist_stmt);
				
				echo '<div class="div3"><p>Sikeres regisztráció, jelentkezz be!</p><a href="loginForm.php"><input type="submit" value="Bejelentkezés" name="goMainPage" class="buttonType"/></a></div>';
			

	}
	else {
	echo '<div class="div3"><p>Már van ilyen nevű felhasználó!</p><a href="registForm.php"><input type="submit" value="Vissza" name="goBack" class="buttonType"/></a></div>';

}

function letezo_felhasznalo($user){
	
	if ( !($conn = connect()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
		
	$userek = oci_parse($conn, 'SELECT FELHASZNALONEV FROM SZEMELY');
	oci_execute($userek);
	
	while ( $row = oci_fetch_array($userek, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			if($item==$user) {
				return true;
			} 
		}	
	}
	return false;
}
function letezo_bankszamla($bank){
	
	if ( !($conn = connect()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
		
	$bankszamlak = oci_parse($conn, 'SELECT BANKSZAMLASZAM FROM BANKSZAMLA');
	oci_execute($bankszamlak);
	
	while ( $row = oci_fetch_array($bankszamlak, OCI_ASSOC + OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			if($item==$bank) {
				return true;
			} 
		}	
	}
	return false;
}

?>