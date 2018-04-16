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
		include_once("queries.php");
		
		$conn = connect();
	?>
	
	<div class="div1">
		<a href="loginForm.php" ><input type="submit" style="font-size:13px;" value="Bejelentkezés" name="loginButton" class="buttonType"/></a>
		<a href="registForm.php" ><input type="submit" style="font-size:13px;" value="Regisztráció" name="registButton" class="buttonType"/></a>
	</div>
	<header>
		<form action="index.html">
		<a href="index.html"><img src="airplane.png" id="airplaneImg"/></a>
				  <h1>Repülőjegy foglalás</h1>	
				  <h4>Találd meg a számodra megfelelõ ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvezõ ajánlatok között!</h4>
			
		</form>
	</header>
	<div class="container1">
	<form method="POST">
		<div class="search">
			<p style="font-size:22px; margin-top:1%; padding-top:1%; font-weight: bold;">Járat keresése</p>
			<p>Honnan:</p><select name="honnan">
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
			<p>Hova:</p><select name="hova">
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
			<p>Indulás dátuma</p><input type="date" name="startDate" required min="1900-01-01"/>	
			<p>Érkezés dátuma</p><input type="date" name="arriveDate" min="1900-01-01"/>
			<p>Felnõttek száma (kor: 14-):</p><input type="text" name="numberOfAdults"  size="2" class="inputType" />	
			<p>Gyerekek száma (kor: 0-14):</p><input type="text" name="numberOfAdults"  size="2" class="inputType" />
			<p>Étkezés:</p><input type="radio" name="food" value="yes" class="radioType" >Igen</input>
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
					<th>Légitársaság neve</th>
					<th>Repülõ típusa</th>					
					<th>Ár</th>
					<th/>
				</tr>
				<?php
					$day = null;
				
					if(ISSET($_POST["searchButton"])) {
						if(ISSET($_POST["startDate"])){
							$startDate = $_POST["startDate"];
			
							$day = getMenetrend($startDate);
			
						} else {
							error_log("Valamelyik mező nincs kitöltve!");
						}
					}
										
					$sql = "SELECT * FROM MENETREND WHERE NAP = '".$day."'";
					
					$stmt = oci_parse($conn, $sql);
					
					oci_execute($stmt);
					
					while ( $row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
						echo '<tr>';
						foreach($row as $item) {
							echo '<td>' . $item . '</td>';
						}
						echo '</tr>';
					}
				
				?>

			</table>
				
		</div>
	<div>

	
	
	
  
  
  </body>
</html>
