<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8"/>
    <meta name="description" content="Főoldal"/>
    <meta name="keywords" content="HTML,CSS"/>
    <meta name="author" content=""/>
    <title>Repülőjegy foglalás</title>
    <link rel="stylesheet" type="text/css" href="stiluslap.css" />   
  </head>
  <body>
	<div class="div1">
		<a href="registForm.php" ><input type="submit" style="font-size:13px;" value="Regisztráció" name="registButton" class="buttonType"/></a>
	</div>
	<header>
		<form action="index.php">
		<a href="index.php"><img src="airplane.png" id="airplaneImg"/></a>
			<h1>Repülőjegy foglalás</h1>	
			<h4>Találd meg a számodra megfelelő ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvező ajánlatok között!</h4>
		</form>
	</header>
	<div class="loginDiv">
		<h2>Bejelentkezés</h2>
			<form method="POST" action="login.php">			
				<p>Felhasználónév:</p><input type="text" name="user" required size=15 class="inputType" />
				<br/>
				<p>Jelszó:</p> <input type="password" name="pass" required size=15 class="inputType"/>
				<br/>			
				<input type="submit" style="padding:10px; margin-top:15%;  width:230px;"  value="Bejelentkezés" name="login" class="buttonType"/>
			</form>
	</div>	
	</body>
</html>