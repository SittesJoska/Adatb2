<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8"/>
    <meta name="description" content="Fõoldal"/>
    <meta name="keywords" content="HTML,CSS"/>
    <meta name="author" content=""/>
    <title>Repülõjegy foglalás</title>
    <link rel="stylesheet" type="text/css" href="stiluslap.css" />   
  </head>
  
  <body>
  
	<?php
		session_start();
		
		include_once 'queries.php';
		$conn = connect();
		
		if(!isset($_SESSION['user'])){
			include "menu.html";
			echo '<div class="div3"><p>Nem vagy bejelentkezve...</p></div>';
			header('Refresh: 2; URL = index.php');
			die();
		}
	?>
	
	<header>
		<form action="mainPage.php">
		<a href="mainPage.php"><img src="airplane.png" id="airplaneImg"/></a>
				  <h1>Repülőjegy foglalás</h1>	
				  <h4>Találd meg a számodra megfelelõ ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvezõ ajánlatok között!</h4>
			
		</form>
	</header>
	
	<div class="div1" >
		<a href="mainPage.php" ><input type="submit" style="font-size:13px;" value="Főoldal" name="mainPageButton" class="buttonType"/></a>
		<a href="reservationsPage.php" ><input type="submit" style="font-size:13px;" value="Foglalásaim" name="reservationsButton" class="buttonType"/></a>
		<a href="userPage.php" ><input type="submit" style="font-size:13px;" value="Felhasználói adatok" name="userButton" class="buttonType"/></a>
		
		<form method='GET' style='display:inline;' action='logout.php'><input type="submit" style="font-size:13px; float:right" value="Kijelentkezés" name="logoutButton" class="buttonType"/></form>
		<div style="margin-right:1%; margin-top:8px; float:right; font-weight: 900; color:#99183f; font-family:New Century; font-size:15px;"><?php echo $_SESSION["user"]?></div>
	</div>
	
	<div class="container1" style="margin-top:4%;">	
		
		<div class="myReservationsDiv">
			<p style="font-size:28px; margin-top:3%; text-align:center; padding-top:1%; font-weight: bold;">Felhasználók törlése (admin)</p>
			
			<table>
				<tr>
					<th>Felhasználónév</th>
					<th>Jelszó</th>
					<th>Név</th>
					<th>Telefonszám</th>
					<th>Email-cim</th>
					<th>Bankszámlaszám</th>					
				</tr>
				
					<?php
						$felhasznaloSql = "SELECT FELHASZNALONEV FROM SZEMELY WHERE FELHASZNALONEV NOT LIKE 'admin'";
						$felhasznaloStmt = oci_parse($conn,$felhasznaloSql);
						oci_execute($felhasznaloStmt);
						
						while ( $row = oci_fetch_array($felhasznaloStmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
								echo '<tr>';
								echo '<form method=POST>';
								foreach ($row as $item) {
									echo '<td>'. $item . '</td>';
									$userDataSql = "SELECT JELSZO, NEV, TELEFONSZAM, EMAIL_CIM, BANKSZAMLASZAM FROM SZEMELY WHERE FELHASZNALONEV = '".$item."'";
									$userDataStmt = oci_parse($conn,$userDataSql);
									oci_execute($userDataStmt);
									while ( $dataRow = oci_fetch_array($userDataStmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
										foreach ($dataRow as $user_data) {
											echo '<td>'. $user_data . '</td>';
										}
									}
									
								}
					?>
									<td><input type="submit" style="padding:2px; margin:2%;  width:100px;" value="Törlés" name="deleteUser" class="buttonType"/></td>
									<td><input type="hidden" name="selectedUser" value="<?php echo $item ?>"/></td>
					<?php
								echo '</form>';
								echo '</tr>';
						}
						
						if(isset($_POST["deleteUser"])) {
						$selectedUserCount = $_POST["selectedUser"];
						
						deleteAccountByAdmin($selectedUserCount);
						
						header('Refresh: 0.5; URL = admin_user_delete.php');
						}
					?>
			</table>
		</div>
	
	</div>
  </body>
 
 </html>