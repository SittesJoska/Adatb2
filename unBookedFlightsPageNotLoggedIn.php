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
			include_once 'queries.php';
		
			$conn = connect();
		?>
	<div class="div1">
		<a href="loginForm.php" ><input type="submit" style="font-size:13px;" value="Bejelentkezés" name="loginButton" class="buttonType"/></a>
		<a href="registForm.php" ><input type="submit" style="font-size:13px;" value="Regisztráció" name="registButton" class="buttonType"/></a>
	</div>
	<header>
		<form action="index.php">
		<a href="index.php"><img src="airplane.png" id="airplaneImg"/></a>
				  <h1>Repülőjegy foglalás</h1>	
				  <h4>Találd meg a számodra megfelelõ ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvezõ ajánlatok között!</h4>
			
		</form>
	</header>
	
	<div class="container1" style="margin-top:4%;">	
		
		<div class="myReservationsDiv">
			
			<input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Vissza" name="goBackButton" class="buttonType"/>
			<a href="loginForm.php"><input type="submit" style="font-size:13px; margin-top:1%; float:right; margin-left:5px;" value="Bejelentkezés" name="loginButton" class="buttonType"/></a>
			<form action="hotelsNotLoggedIn.php" method="POST"><input type="submit" style="font-size:13px; float:right; margin-left:5px; margin-top:1%;"  value="Szállodák" name="hotelsButton" class="buttonType"/></form>
			<p style="font-size:28px; margin-top:3%; text-align:center; padding-top:1%; font-weight: bold;">Választott foglalás</p>
			<table>
				<tr>
					<th>Azonosító</th>
					<th>Honnan</th>
					<th>Hova</th>
					<th>Indulás</th>
					<th>Érkezés</th>
					<th>Légitársaság neve</th>
					<th>Repülő típusa</th>
					<th>Biztosító neve</th>	
					<th>Biztosítási kategória</th>
					<th>Kárpótlás</th>						
				</tr>
			</table>			
		<div style="text-align:center; margin:auto; margin-top:4%;width=50%;"><input type="submit" style="font-size:20px; margin-left:5px;" value="Lefoglal" name="bookButton" class="buttonType"/></div>			
		</div>
		<div class="container2">
					<p>Átszállások száma: 1</p>	
					<p>Felnőttek száma: 4</p>	
					<p>Gyerekek száma: 2</p>
					<p>Osztály: 1</p>	
					<p>Étkezés: Igen</p>	
					<p>Ár: 250 €</p>	
			</div>			
	</div>
	
	
	
  
  
  </body>
</html>
