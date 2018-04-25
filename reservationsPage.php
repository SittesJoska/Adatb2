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
		<div class="myReservationsDiv">
			<p style="font-size:28px; margin-top:1%; text-align:center; padding-top:1%; font-weight: bold;">Foglalásaim</p>
			<table>
				<tr>
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
				<?php 
					$sql = "SELECT FOGLALAS_ID FROM SZEMELYFOGLALASAI WHERE FELHASZNALONEV = '".$_SESSION["user"]."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
										
					while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
						foreach ($row as $item) {
							$felnottSql = "SELECT FELNOTTEK_SZAMA FROM FOGLALAS WHERE FOGLALAS_ID = '".$item."'";
							$felnottStmt = oci_parse($conn, $felnottSql);
							oci_execute($felnottStmt);
							$felnottRow = oci_fetch_row($felnottStmt);
							$felnottek_szama = $felnottRow[0];
									
							$gyerekSql = "SELECT GYEREKEK_SZAMA FROM FOGLALAS WHERE FOGLALAS_ID = '".$item."'";
							$gyerekStmt = oci_parse($conn, $gyerekSql);
							oci_execute($gyerekStmt);
							$gyerekRow = oci_fetch_row($gyerekStmt);
							$gyerekek_szama = $gyerekRow[0];
							
							$etkezesSql = "SELECT OSZTALY FROM FOGLALAS WHERE FOGLALAS_ID = '".$item."'";
							$etkezesStmt = oci_parse($conn, $etkezesSql);
							oci_execute($etkezesStmt);
							$etkezesRow = oci_fetch_row($etkezesStmt);
							$etkezes = strcmp($etkezesRow[0], 'yes') == 0 ? 'Igen' : 'Nem';
							
							$osztalySql = "SELECT OSZTALY FROM FOGLALAS WHERE FOGLALAS_ID = '".$item."'";
							$osztalyStmt = oci_parse($conn, $osztalySql);
							oci_execute($osztalyStmt);
							$osztalyRow = oci_fetch_row($osztalyStmt);
							$osztaly = $osztalyRow[0];
									
							$datumSql = "SELECT DATUM FROM FOGLALAS WHERE FOGLALAS_ID = '".$item."'";
							$datumStmt = oci_parse($conn, $datumSql);
							oci_execute($datumStmt);
							$datumRow = oci_fetch_row($datumStmt);
							$datum = date('Y-m-d', strtotime($datumRow[0]));
							
							$menetrendSql = "SELECT JARAT.MENETREND_ID FROM JARAT INNER JOIN FOGLALAS ON JARAT.JARAT_ID = FOGLALAS.JARAT_ID WHERE FOGLALAS_ID = '".$item."'";
							$menetrendStmt = oci_parse($conn, $menetrendSql);
							oci_execute($menetrendStmt);
							while($menetrendRow = oci_fetch_array($menetrendStmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
								echo '<tr>';
								echo '<form method=POST>';
								foreach ($menetrendRow as $menetrendId) {
									$honnanSql = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE MENETREND_ID = '".$menetrendId."' AND INDUL_ERKEZIK = 'indul'";
									$honnanStmt = oci_parse($conn, $honnanSql);
									oci_execute($honnanStmt);
									$honnanRow = oci_fetch_row($honnanStmt);
									$honnan = $honnanRow[0];
									
									$hovaSql = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE MENETREND_ID = '".$menetrendId."' AND INDUL_ERKEZIK = 'érkezik'";
									$hovaStmt = oci_parse($conn, $hovaSql);
									oci_execute($hovaStmt);
									$hovaRow = oci_fetch_row($hovaStmt);
									$hova = $hovaRow[0];
									
									$ido = getIndulas($menetrendId);
												
									$idotartam = getUtazasIdotartam($menetrendId);
												
									$ora = floor($idotartam/60);
									$perc = $idotartam%60;
																		
									$erkezesOra = $ido[0] + $ora;
									$erkezesPerc = $ido[1] + $perc;
											
									if($erkezesPerc >= 60) {
										$erkezesOra += floor($erkezesPerc/60);
										$erkezesPerc = $erkezesPerc%60;
									}
											
									$erkezesNap = $datum;
																
									if($erkezesOra >= 24) {
										$incrementNap = strtotime("+1 day", strtotime($erkezesNap));
										$erkezesNap = date('Y-m-d', $incrementNap);
										$erkezesOra -= 24;
									}
									
									if($ido[1] == 0) {
										$ido[1] = '00';
									}
									
									echo '<td>' . $honnan . '</td><td>' . $hova . '</td><td>' . $datum . ' ' . $ido[0] . ':' . $ido[1] . '</td><td>' . $erkezesNap . ' ' . $erkezesOra . ':' . $erkezesPerc . 
										'</td><td>'. $atszallas .'</td><td> Óra: ' . $ora . ' Perc: ' . $perc . '</td><td>' . $felnottek_szama . '</td><td>' . $gyerekek_szama . '</td><td>' . $osztaly . 
										'</td><td>' . $etkezes . '</td>';
									?>
										<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
										<td><input type="submit" style="font-size:11px;" value="Töröl" name="deleteButton" class="buttonType"/></td>
										<td><input type="hidden" name="selectedFoglalas" value='<?php echo $item ?>'/></td>
									<?php
								}
								echo '</form>';
								echo '</tr>';
							}
						}
					}
					
					if(isset($_POST["deleteButton"])) {
						$selectedFoglalas = $_POST["selectedFoglalas"];
						$felhasznaloSql = "DELETE FROM FOGLALAS WHERE FOGLALAS_ID = '".$selectedFoglalas."'";
						$felhasznaloStmt = oci_parse($conn, $felhasznaloSql);
						oci_execute($felhasznaloStmt);		
					}
				?>				
			</table>
				
		</div>
	<div>

	
	
	
  
  
  </body>
</html>
