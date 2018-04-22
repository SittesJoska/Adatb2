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
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$referer = $_SERVER['HTTP_REFERER'];
			$myarray = preg_split("[/]",$referer);
			$lastEl = array_values(array_slice($myarray, -1))[0];
			if(strcmp($lastEl, 'mainPage.php') == 0) {
				unset($_SESSION['biztosito_neve']);
				unset($_SESSION['biztosito_kategoria']);
			}

		}else{
			unset($_SESSION['biztosito_neve']);
			unset($_SESSION['biztosito_kategoria']);
		}

		include_once 'queries.php';
		
		$conn = connect();
		
		$honnan = $_SESSION["honnan"];
		$hova = $_SESSION["hova"];
		$startDate = $_SESSION["startDate"];
		$indulasOra = $_SESSION["indulasOra"];
		$indulasPerc = $_SESSION["indulasPerc"];
		$erkezesNap = $_SESSION["erkezesNap"];
		$erkezesOra = $_SESSION["erkezesOra"];
		$erkezesPerc = $_SESSION["erkezesPerc"];
		
		$felnott = $_SESSION["felnottSzam"];
		$gyerek = $_SESSION["gyerekSzam"];
		$osztaly = $_SESSION["osztaly"];
		$etkezes = $_SESSION["etkezes"];
		$atszallas = $_SESSION["atszallas"];
		
		$legitarsasag = $_SESSION["legitarsasagNev"];
		$repuloTipus = $_SESSION["repulo_tipus"];

		$ar = $_SESSION["ar"];
		
		if(!isset($_SESSION['user'])){
			include "menu.html";
			echo '<div class="div3"><p>Nem vagy bejelentkezve...</p></div>';
			header('Refresh: 2; URL = index.php');
			die();
		}
		$selectedBiztosito = null;
		if(isset($_POST['biztosito_neve'])) {
			$_SESSION['biztosito_neve'] = $_POST['biztosito_neve'];
		}
		$selectedKategoria = null;
		if(isset($_POST['biztosito_kategoria'])) {
			$_SESSION['biztosito_kategoria'] = $_POST['biztosito_kategoria'];
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
			
			<input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Vissza" name="goBackButton" class="buttonType"/>			
			<form action="hotelsLoggedIn.php" method="POST"><input type="submit" style="font-size:13px; float:right; margin-top:1%; margin-left:5px;" value="Szállodák" name="hotelsButton" class="buttonType"/></form>
			<p style="font-size:28px; margin-top:3%; text-align:center; padding-top:1%; font-weight: bold;">Választott foglalás</p>
			<table>
				<tr>
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
				<tr>
					<td><?php echo $honnan; ?></td>
					<td><?php echo $hova; ?></td>
					<td><?php echo $startDate . ' ' . $indulasOra . ':' . $indulasPerc; ?></td>
					<td><?php echo $erkezesNap . ' ' . $erkezesOra . ':' . $erkezesPerc; ?></td>
					<td><?php echo $legitarsasag; ?></td>
					<td><?php echo $repuloTipus; ?></td>
					<td><form method="POST"><select name="biztosito_neve" class="inputType" onchange="this.form.submit();">
								<option disabled selected value> Válasszon! </option>
								<?php
									$biztosito = "SELECT NEV FROM BIZTOSITO WHERE LEGITARSASAG_NEV = '".$legitarsasag."'";
									$stmtBiztosito = oci_parse($conn, $biztosito);
									oci_execute($stmtBiztosito);
												
									while ( $row = oci_fetch_array($stmtBiztosito, OCI_ASSOC + OCI_RETURN_NULLS)) {
										foreach ($row as $item) {
											if(strcmp($_SESSION['biztosito_neve'], $item) == 0) {
												$selected = 'selected="selected"';
											} else {
												$selected = '';
											}
											echo '<option ';
											echo $selected;
											echo '>';
											echo $item;
											echo '</option>';
										}
									}
								?>
							</select></form></td>
					<td><form method="POST"><select name="biztosito_kategoria" class="inputType" onchange="this.form.submit()">
								<option disabled selected value> Válasszon! </option>
								<?php
									$selectedBiztosito = $_SESSION['biztosito_neve'];
									$kategoriaSql = "SELECT KATEGORIA FROM BIZTOSITO WHERE NEV = '".$selectedBiztosito."' AND LEGITARSASAG_NEV = '".$legitarsasag."'";
									$stmtKategoria = oci_parse($conn, $kategoriaSql);
									oci_execute($stmtKategoria);
												
									while ( $row = oci_fetch_array($stmtKategoria, OCI_ASSOC + OCI_RETURN_NULLS)) {
										foreach ($row as $item) {
											if(strcmp($_SESSION['biztosito_kategoria'], $item) == 0) {
												$selected2 = 'selected="selected"';
											} else {
												$selected2 = '';
											}
											echo '<option ';
											echo $selected2;
											echo '>';
											echo $item;
											echo '</option>';
										}
									}
								?>
							</select></form></td>
					<td><?php
						if(isset($_SESSION['biztosito_kategoria'])) {
							$selectedKategoria = $_SESSION['biztosito_kategoria'];
						}

						$karpotlasSql = "SELECT KARPOTLAS FROM BIZTOSITO WHERE NEV = '".$selectedBiztosito."' AND KATEGORIA = '".$selectedKategoria."'";
						$karpotlasStmt = oci_parse($conn, $karpotlasSql);
						oci_execute($karpotlasStmt);
						$karpotlas = oci_fetch_row($karpotlasStmt);
						
						echo $karpotlas[0];
					?></td>


				</tr>
				
				
				<tr>
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
