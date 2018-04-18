﻿<!DOCTYPE html>
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
		include_once("queries.php");
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
	<form method="POST">
		<div class="container1" style="margin-top:4%;">
			<div class="search">
				<p style="font-size:22px; margin-top:1%; padding-top:1%; font-weight: bold;">Járat keresése</p>
				<p>Honnan:</p><select name="honnan" class="inputType">
								<option disabled selected value> Válasszon! </option>
								<?php
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
				<p>Hova:</p><select name="hova" class="inputType">
								<option disabled selected value> Válasszon! </option>
								<?php
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
				<p>Indulás dátuma</p><input type="date" name="startDate" required min="<?php echo date('Y-m-d');?>" class="inputType"/>	
				<p>Felnõttek száma (kor: 14-):</p><input type="text" name="numberOfAdults" required size="2" class="inputType" />	
				<p>Gyerekek száma (kor: 0-14):</p><input type="text" name="numberOfChildren" required size="2" class="inputType" />
				<p>Osztály:</p>
				<input type="radio" name="seat" value="first" class="radioType" required>Elsőosztály</input>
				<input type="radio" name="seat" value="second" class="radioType" >Másodosztály</input>
				<p>Étkezés:</p><input type="radio" name="food" value="yes" class="radioType" required>Igen</input>
							<input type="radio" name="food" value="no" class="radioType" >Nem</input>	
				<br/><input type="submit" style="margin-top:10%;" value="Keresés" name="searchButton" class="buttonType"/>
			</div>
		</form>
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
				<?php
					$day = null;
					$honnan = null;
				
					if(ISSET($_POST["searchButton"])) {
							$honnan = $_POST["honnan"];
							$hova = $_POST["hova"];
							$startDate = $_POST["startDate"];
							$felnott = $_POST["numberOfAdults"];
							$gyerek = $_POST["numberOfChildren"];
							$seat = $_POST["seat"];
							$etkezes = $_POST["food"];
							
							$day = getMenetrend($startDate);
					}
										
					$sql = "SELECT MENETREND.Menetrend_id FROM KOZLEKEDIK INNER JOIN MENETREND ON MENETREND.Menetrend_id = KOZLEKEDIK.Menetrend_id WHERE MENETREND.NAP = '".$day."' 
					AND KOZLEKEDIK.VAROS_NEV = '".$honnan."' AND KOZLEKEDIK.INDUL_ERKEZIK = 'indul'";
					
					$stmt = oci_parse($conn, $sql);
					
					oci_execute($stmt);
					
					while($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
						echo '<tr>';
						foreach ($row as $item) {
							$sql2 = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE Menetrend_id = '".$item."' AND INDUL_ERKEZIK = 'indul' AND VAROS_NEV = '".$honnan."'";
							$stmt2 = oci_parse($conn, $sql2);
							oci_execute($stmt2);
							$varos = oci_fetch_row($stmt2);
							
							$sql3 = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE Menetrend_id = '".$item."' AND INDUL_ERKEZIK = 'érkezik' AND VAROS_NEV = '".$hova."'";
							$stmt3 = oci_parse($conn, $sql3);
							oci_execute($stmt3);
							$varos2 = oci_fetch_row($stmt3);
							
							$oraSql = "SELECT ORA, PERC FROM MENETREND WHERE Menetrend_id = '".$item."' AND NAP = '".$day."'";
							$oraStmt = oci_parse($conn, $oraSql);
							oci_execute($oraStmt);
							$ido = oci_fetch_row($oraStmt);
							
							$menetidoSql = "SELECT Menetido FROM UTAZASIDOTARTAM WHERE TAV = (SELECT TAV FROM MENETREND WHERE Menetrend_id = '".$item."')";
							$menetStmt = oci_parse($conn, $menetidoSql);
							oci_execute($menetStmt);
							$idotartam = oci_fetch_row($menetStmt);
							$ora = floor($idotartam[0]/60);
							$perc = $idotartam[0]%60;
														
							$erkezesOra = $ido[0] + $ora;
							$erkezesPerc = $ido[1] + $perc;
							
							if($erkezesPerc >= 60) {
								$erkezesOra += floor($erkezesPerc/60);
								$erkezesPerc = $erkezesPerc%60;
							}
							
							$erkezesNap = $startDate;
							
							if($erkezesOra >= 24) {
								$erkezesNap = $startDate + '1 day';
								$erkezesOra -= 24;
							}

							$ar = 80000;
							
							if($ido[1] == 0) {
								$ido[1] = '00';
							}
							
							echo '<td>' . $varos[0] . '</td><td>' . $varos2[0] . '</td><td>' . $startDate . ' ' . $ido[0] . ':' . $ido[1] . '</td>
							<td>' . $erkezesNap . ' ' . $erkezesOra . ':' . $erkezesPerc . '</td><td> 0 </td><td> Óra: ' . $ora . ' Perc: ' . $perc . '</td><td>' . $ar . '</td>';
							?>
								<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
							<?php
						}
						echo '</tr>';
					}
					
					$sql2 = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE VAROS_NEV = '".$hova."' AND INDUL_ERKEZIK = 'indul'";
					
					$stmt2 = oci_parse($conn, $sql2);
					
					oci_execute($stmt2);
					
					while($row = oci_fetch_array($stmt2, OCI_ASSOC + OCI_RETURN_NULLS)) {
						foreach ($row as $item) {
							$sql3 = "SELECT MENETREND.Menetrend_id FROM MENETREND INNER JOIN KOZLEKEDIK ON MENETREND.Menetrend_id = KOZLEKEDIK.Menetrend_id WHERE KOZLEKEDIK.VAROS_NEV = '".$item."' AND KOZLEKEDIK.INDUL_ERKEZIK = 'indul'";
							
							$stmt3 = oci_parse($conn, $sql3);
							
							oci_execute($stmt3);
							
							while($row2 = oci_fetch_array($stmt3, OCI_ASSOC + OCI_RETURN_NULLS)) {
								echo '<tr>';
								foreach ($row2 as $item2) {
									$sql4 = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE Menetrend_id = '".$item2."' AND INDUL_ERKEZIK = 'indul' AND VAROS_NEV = '".$item."'";
									$stmt4 = oci_parse($conn, $sql4);
									oci_execute($stmt4);
									$varos3 = oci_fetch_row($stmt4);
									
									$sql5 = "SELECT VAROS_NEV FROM KOZLEKEDIK WHERE Menetrend_id = '".$item2."' AND INDUL_ERKEZIK = 'érkezik'";
									$stmt5 = oci_parse($conn, $sql5);
									oci_execute($stmt5);
									$varos4 = oci_fetch_row($stmt5);
									
									$oraSql2 = "SELECT ORA, PERC FROM MENETREND WHERE Menetrend_id = '".$item2."'";
									$oraStmt2 = oci_parse($conn, $oraSql2);
									oci_execute($oraStmt2);
									$ido2 = oci_fetch_row($oraStmt2);
									
									$menetidoSql2 = "SELECT Menetido FROM UTAZASIDOTARTAM WHERE TAV = (SELECT TAV FROM MENETREND WHERE Menetrend_id = '".$item2."')";
									$menetStmt2 = oci_parse($conn, $menetidoSql2);
									oci_execute($menetStmt2);
									$idotartam2 = oci_fetch_row($menetStmt2);
									$ora2 = floor($idotartam2[0]/60);
									$perc2 = $idotartam2[0]%60;
																
									$erkezesOra2 = $ido2[0] + $ora2;
									$erkezesPerc2 = $ido2[1] + $perc2;
									
									if($erkezesPerc2 >= 60) {
										$erkezesOra2 += floor($erkezesPerc2/60);
										$erkezesPerc2 = $erkezesPerc2%60;
									}
									
									$erkezesNap2 = $startDate;
									
									$sql6 = "SELECT NAP FROM MENETREND WHERE Menetrend_id = '".$item."'";
									$stmt6 = oci_parse($conn, $sql6);
									oci_execute($stmt6);
									$atszallasnap = oci_fetch_row($stmt6);
									
									while(true) {
										
										if($atszallasnap[0] = getMenetrend($erkezesNap2)) {
											break;
										}
										$erkezesNap2 = date('Y-m-d', strtotime($erkezesNap2 . ' +1 day'));
									}
																		
									if($erkezesOra2 >= 24) {
										$erkezesNap2 = date('Y-m-d', strtotime($erkezesNap2 . ' +1 day'));
										$erkezesOra2 -= 24;
									}

									$ar2 = 80000;
									
									if($ido2[1] == 0) {
										$ido2[1] = '00';
									}
									
									echo '<td>' . $varos3[0] . '</td><td>' . $varos4[0] . '</td><td>' . $startDate . ' ' . $ido2[0] . ':' . $ido2[1] . '</td>
									<td>' . $erkezesNap2 . ' ' . $erkezesOra2 . ':' . $erkezesPerc2 . '</td><td> 0 </td><td> Óra: ' . $ora2 . ' Perc: ' . $perc2 . '</td><td>' . $ar2 . '</td>';
									?>
										<td><input type="submit" style="font-size:11px;" value="Kiválaszt" name="chooseButton" class="buttonType"/></td>
									<?php
								}
									echo '</tr>';
							}
						}
					}						
					
				
				?>

			</table>
				
		</div>
	<div>

	
	
	
  
  
  </body>
</html>