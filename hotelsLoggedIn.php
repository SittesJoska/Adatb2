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
		<div class="loginDiv" style="margin-top:2%;">
		
		<h2><?php echo $_SESSION["hova"] ?></h2>
		<?php 
			include_once("queries.php");
			$conn = connect();
			$szalloda_sql = "SELECT SZALLODA_NEV FROM SZALLODA WHERE VAROS_NEV='".$_SESSION['hova']."'";
			$szalloda_stmt = oci_parse($conn,$szalloda_sql);
			
			oci_execute($szalloda_stmt);
			while ( $row = oci_fetch_array($szalloda_stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
				echo '<ul>';
				foreach ($row as $item) {
					echo '<li>'.$item.'</li>';
				}
				echo '</ul>';
			}
			echo '<a href="unBookedFlightsPageLoggedIn.php" ><input type="submit" style="font-size:13px;" value="Vissza" name="goBackButton" class="buttonType"/></a>';
		?>
		<!--<ul>
			<li>Szálloda 1</li>
			<li>Szálloda 2</li>
			<li>Szálloda 3</li>
			<li>Szálloda 4</li>
			<li>Szálloda 5</li>
		</ul>
		<a href="userPage.php" ><input type="submit" style="font-size:13px;" value="Vissza" name="goBackButton" class="buttonType"/></a>-->
		
	</div>

	
  </body>
</html>
