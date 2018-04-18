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
  <div class="div1">
		<a href="loginForm.php" ><input type="submit" style="font-size:13px;" value="Bejelentkezés" name="loginButton" class="buttonType"/></a>
		<a href="registForm.php" ><input type="submit" style="font-size:13px;" value="Regisztráció" name="registButton" class="buttonType"/></a>
	</div>
	<header>
		<form action="index.php">
		<a href="index.php"><img src="airplane.png" id="airplaneImg"/></a>
				  <h1>Repülőjegy foglalás</h1>	
				  <h4>Találd meg a számodra megfelelõ ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvezõ ajánlatok között!</h4>
			
		</form>
	</header>
	<div class="container1" style="margin-top:4%;">
		<div class="loginDiv" style="margin-top:2%;">
		
		<h2>Város neve</h2>
		<ul>
			<li>Szálloda 1</li>
			<li>Szálloda 2</li>
			<li>Szálloda 3</li>
			<li>Szálloda 4</li>
			<li>Szálloda 5</li>
		</ul>
		<a href="userPage.php" ><input type="submit" style="font-size:13px;" value="Vissza" name="goBackButton" class="buttonType"/></a>
		
	</div>

	
  </body>
</html>
