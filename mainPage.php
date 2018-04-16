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
		<div class="search">
			<p style="font-size:22px; margin-top:1%; padding-top:1%; font-weight: bold;">Járat keresése</p>
			<p>Honnan:</p><select name="honnan" class="inputType">
							<option disabled selected value> Válasszon! </option>
							<?php
								include_once("connection.php");
								$sql = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE INDUL_ERKEZIK = 'indul'";
								$stid = oci_parse($conn, $sql); 
     
								oci_execute($stid);

								while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
									echo '<option>';
									foreach ($row as $item) {
										echo $item ;
									}
									echo '</option>';
								}
							?>
						</select>
			<p>Honnan:</p><select name="honnan" class="inputType">
							<option disabled selected value> Válasszon! </option>
							<?php
								include_once("connection.php");
								$sql = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE INDUL_ERKEZIK = 'érkezik'";
								$stid = oci_parse($conn, $sql); 
     
								oci_execute($stid);

								while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
									echo '<option>';
									foreach ($row as $item) {
										echo $item ;
									}
									echo '</option>';
								}
							?>
						</select>
			<p>Indulás dátuma</p><input type="date" name="startDate" required min="1900-01-01" class="inputType"/>	
			<p>Felnõttek száma (kor: 14-):</p><input type="text" name="numberOfAdults" required size="2" class="inputType" />	
			<p>Gyerekek száma (kor: 0-14):</p><input type="text" name="numberOfAdults" required size="2" class="inputType" />
			<p>Étkezés:</p><input type="radio" name="food" value="yes" class="radioType" required>Igen</input>
						<input type="radio" name="food" value="no" class="radioType" >Nem</input>	
			<br/><input type="submit" style="margin-top:10%;" value="Keresés" name="searchButton" class="buttonType"/>
		</div>
		<div class="result">
			<p style="font-size:28px; margin-top:1%; text-align:center; padding-top:1%; font-weight: bold;">Találatok</p>
			<table>
				<tr>
					<th>Honnan</th>
					<th>Honnan</th>
					<th>Indul</th>
					<th>Érkezik</th>
					<th>Átszállások száma</th>
					<th>Utazás idõtartama</th>												
					<th>Ár</th>
					<th/>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>
				<tr>
					
					<td>Budapest</td>
					<td>Szingapúr</td>
					<td>2018.04.15. 13:00</td>
					<td>2018.04.16. 18:00</td>
					<td>1</td>
					<td>18:40</td>
					<td>150 €</td>
					<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
				</tr>

			</table>
				
		</div>
	<div>

	
	
	
  
  
  </body>
</html>
