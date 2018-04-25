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
	<div class="loginDiv" style="margin-top:7%;">		

		<?php			
			$username=$_SESSION['user'];
			$password=$_SESSION['pass'];
			$passwordConfirm=$_SESSION['pass'];
			$fullName=$_SESSION['fullName'];
			$accountNumber=$_SESSION['accountNumber'];
			$accountMoney=$_SESSION['accountMoney'];
			$email=$_SESSION['email'];
			$phoneNumber=$_SESSION['phoneNumber'];
		
			echo '<h2>Adatok</h2>';
			echo'<form method="POST" action="modifyUserData.php">';	
			echo sprintf('<p>Felhasználónév:</p><input readonly type="text" value="%s" name="username" required="true" size="15" maxlength="30" class="inputType"/>',htmlspecialchars($username));			
			echo sprintf('<p>Jelszó:</p> <input type="password" value="%s" name="password" pattern=".{5,30}"  maxlength="30" required="true" size="15" class="inputType"/>',htmlspecialchars($password));	
			echo sprintf('<p>Jelszó megerősítése:</p> <input type="password" value="%s" name="passwordConfirm"  maxlength="30" required="true" size="15" class="inputType"/>',htmlspecialchars($passwordConfirm));			
			echo sprintf('<p>Név:</p><input readonly  type="text" value="%s" name="name" required="true" size="15" maxlength="50" class="inputType" />', htmlspecialchars($fullName));
			echo sprintf('<p>E-mail cím:</p><input type="email" value="%s" name="email" required="true" size="15"  maxlength="20" class="inputType" placeholder="valaki@valami.hu" />',htmlspecialchars($email));	
			echo sprintf('<p>Telefonszám:</p><input type="text" value="%s" name="phoneNumber" required="true" size="15" placeholder="203411738" maxlength="9" class="inputType" />',htmlspecialchars($phoneNumber));				
			echo'<input type="submit" style="padding:10px; margin-top:5%; margin-bottom:8%;  width:230px;" value="Módosít" name="modify" class="buttonType"/>';
			echo '</form>';
			
			echo '<form method="POST" action="uploadMoney.php">';
			echo sprintf('<p>Bankszámlaszám:</p><input type="text" readonly value="%s" name="accountNumber" required="true" pattern=".{15,15}" maxlength="15" size="15" class="inputType" />',htmlspecialchars($accountNumber));	
			echo sprintf('<p>Egyenleg:</p><input readonly type="text" value="%s" name="accountMoney" required="true" size="15" class="inputType" /><br/>',htmlspecialchars($accountMoney));				
			echo'<input type="submit" style="padding:2px; margin:2%;  width:100px;" value="Feltölt" name="upload" class="buttonType"/>';	
			echo '</form>';
			
			
		?>
	
	
				
	<?php 
		if(strcmp($_SESSION["user"], 'admin') !== 0) {
			echo '<form method="POST">';
				echo '<input type="submit" style="padding:20px; margin:2%;  width:auto;" value="Fiók törlése" name="deleteAccount" class="buttonType"/>';
			echo '</form>';
		}
		
		if(isset($_POST["deleteAccount"])) {
			deleteAccount();
			header('Refresh: 2; URL = index.php');
			die();
		}
	 ?>
	 </div>
  </body>
</html>
