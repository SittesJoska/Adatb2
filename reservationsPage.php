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
			<p style="font-size:28px; margin-top:1%; text-align:center; padding-top:1%; font-weight: bold;">Foglalásaim</p>
			<table>
				<tr>
					<th>Azonosító</th>
					<th>Honnan</th>
					<th>Hova</th>
					<th>Indul</th>
					<th>Érkezik</th>
					<th>Átszállások száma</th>
					<th>Utazás idõtartama</th>	
					<th>Felnőttek száma</th>
					<th>Gyerkek száma</th>										
					<th>Osztály</th>
					<th>Étkezés</th>				
					<th>Ár</th>
					<th/>
				</tr>
				<tr>
					<td>1</td>
					<td>München</td>
					<td>Párizs</td>
					<td>2018.04.16 12:00</td>
					<td>2018.04.16 15:00</td>
					<td>0</td>
					<td>3:00</td>
					<td>4</td>
					<td>1</td>
					<td>1</td>
					<td>Nem</td>
					<td>500 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
					<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
				</tr>
				<tr>
					<td>1</td>
					<td>München</td>
					<td>Párizs</td>
					<td>2018.04.16 12:00</td>
					<td>2018.04.16 15:00</td>
					<td>0</td>
					<td>3:00</td>
					<td>4</td>
					<td>1</td>
					<td>1</td>
					<td>Nem</td>
					<td>500 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
					<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
				</tr>
				<tr>
					<td>1</td>
					<td>München</td>
					<td>Párizs</td>
					<td>2018.04.16 12:00</td>
					<td>2018.04.16 15:00</td>
					<td>0</td>
					<td>3:00</td>
					<td>4</td>
					<td>1</td>
					<td>1</td>
					<td>Nem</td>
					<td>500 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
					<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
				</tr>
				<tr>
					<td>1</td>
					<td>München</td>
					<td>Párizs</td>
					<td>2018.04.16 12:00</td>
					<td>2018.04.16 15:00</td>
					<td>0</td>
					<td>3:00</td>
					<td>4</td>
					<td>1</td>
					<td>1</td>
					<td>Nem</td>
					<td>500 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
					<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
				</tr>
				<tr>
					<td>1</td>
					<td>München</td>
					<td>Párizs</td>
					<td>2018.04.16 12:00</td>
					<td>2018.04.16 15:00</td>
					<td>0</td>
					<td>3:00</td>
					<td>4</td>
					<td>1</td>
					<td>1</td>
					<td>Nem</td>
					<td>500 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
					<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
				</tr>
			</table>
				
		</div>
	<div>

	
	
	
  
  
  </body>
</html>
