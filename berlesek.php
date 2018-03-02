<?php
include_once 'menu.php';
include_once 'lekerdezesek.php';

echo menu();

$conn = connect();

if(ISSET($_POST["submit"])) {
	if(ISSET($_POST["berleti_dij"]) && ISSET($_POST["berles_kezdete"]) && ISSET($_POST["adoszam"]) 
		&& ISSET($_POST["lakasszam"])){

		$berleti_dij = $_POST["berleti_dij"];
		$berles_kezdete = strval($_POST["berles_kezdete"]);
		$berles_vege = strval($_POST["berles_vege"]);
		$adoszam = $_POST["adoszam"];
		$lakasszam = $_POST["lakasszam"];
		
		insertBerles($berleti_dij, $berles_kezdete, $berles_vege, $adoszam, $lakasszam);

	} else {
		error_log("Valamelyik mező nincs kitöltve!");
	}
}

?>
<form method="POST">
Bérleti díj:
<input type="text" name="berleti_dij"/>
<br/>
Bérlés kezdete (Év-hónap-nap):
<input type="text" name="berles_kezdete"/>
<br/>
Bérlés vége (Év-hónap-nap):
<input type="text" name="berles_vege"/>
	<br/>
		Adószám:
		<select name="adoszam">
			<option disabled selected value> -- select an option -- </option>
				
				<?php
				$sql = "SELECT adoszam FROM szemely";
				$res = mysqli_query($conn, $sql) or die ('Hibás utasítás: '.mysqli_error($conn));
				 
				while ( ($current_row = mysqli_fetch_assoc($res))!= null) {
					$adoszam = $current_row["adoszam"];
					echo '<option value='.$adoszam.'>'.$adoszam.'</option>';
				}
				?>				
		</select>
	<br/>
		Lakásszám:
		<select name="lakasszam">
			<option disabled selected value> -- select an option -- </option>
				
				<?php
				$sql = "SELECT lakasszam FROM lakas";
				$res = mysqli_query($conn, $sql) or die ('Hibás utasítás: '.mysqli_error($conn));
				 
				while ( ($current_row = mysqli_fetch_assoc($res))!= null) {
					$lakasszam = $current_row["lakasszam"];
					echo '<option value='.$lakasszam.'>'.$lakasszam.'</option>';
				}
				?>				
		</select>
<br/>
<input type="submit" name="submit" value="Létrehoz"/>
</form>

<h1>Bérlések listája</h1>

<table border="1">
<tr>
<th>Bérleti díj</th>
<th>Bérlés kezdete</th>
<th>Bérlés vége</th>
<th>Adószám</th>
<th>Lakásszám</th>
</tr>

<?php

    $berlesek = getBerlesList();

    while( $egySor = mysqli_fetch_assoc($berlesek) ) { 
        echo '<tr>';
        echo '<form action=berlesquery.php method=POST>';
		echo sprintf("<td>". "<input type=text name=berleti_dij value='%s'></td>",htmlspecialchars($egySor['berleti_dij']));
		echo sprintf("<td>". "<input type=text name=berles_kezdete value='%s'></td>",htmlspecialchars($egySor['berles_kezdete']));
		echo sprintf("<td>". "<input type=text name=berles_vege value='%s'></td>",htmlspecialchars($egySor['berles_vege']));
		echo sprintf("<td>". "<input type=text name=adoszam readonly value='%s'></td>",htmlspecialchars($egySor['adoszam']));
		echo sprintf("<td>". "<input type=text name=lakasszam readonly value='%s'></td>",htmlspecialchars($egySor['lakasszam']));
		echo sprintf("<td>". "<input type=hidden name=selected1 value='%s'></td>",htmlspecialchars($egySor['adoszam']));
		echo sprintf("<td>". "<input type=hidden name=selected2 value='%s'></td>",htmlspecialchars($egySor['lakasszam']));
        echo "<td>". '<input type=submit name=edit value=Módosít />' ."</td>";
        echo "<td>". '<input type=submit name=delete value=Töröl />' ."</td>";
		echo '</form>';
        echo '</tr>';
    } 
    mysqli_free_result($berlesek);
?>
</table>