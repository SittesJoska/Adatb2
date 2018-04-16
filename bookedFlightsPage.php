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
		
		<input type="submit" style="font-size:13px; float:right" value="Kijelentkezés" name="logoutButton" class="buttonType"/>
		<div style="margin-right:1%; margin-top:8px; float:right; color:#273e63; font-family:New Century; font-size:15px;">Felhasználónév</div>
	</div>
	
	<div class="container1" style="margin-top:4%;">	
		
		<div class="myReservationsDiv">
			
			<input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Vissza" name="goBackButton" class="buttonType"/>
			<input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Töröl" name="deleteReservationButton" class="buttonType"/>
			<input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Szállodák" name="hotelsButton" class="buttonType"/>
			<p style="font-size:28px; margin-top:2%; text-align:center; padding-top:1%; font-weight: bold;">Választott foglalás</p>
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
