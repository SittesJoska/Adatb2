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
		<a href="loginForm.php" ><input type="submit" style="font-size:13px;" value="Bejelentkezés" name="loginButton" class="buttonType"/></a>
	</div>
	<header>
		<form action="index.php">
		<a href="index.php"><img src="airplane.png" id="airplaneImg"/></a>
			<h1>Repülőjegy foglalás</h1>	
			<h4>Találd meg a számodra megfelelő ajánlatot, a világ legszebb városaiba. Add meg keresési feltételeidet, és más böngészhetsz is a kedvező ajánlatok között!</h4>
		</form>
	</header>
	<div class="registDiv">	
	<div class="registerImg">
		<img src="newUser.png" id="newUserImg"/>
	</div>
	<div class="registerFields">
	<form method="post" action="regist.php">	
		<h2>Regisztráció</h2>
		<p>Felhasználónév:</p><input type="text" name="username" required="true" size="15" maxlength="30" class="inputType" />			
		<p>Jelszó:</p> <input type="password" name="password" pattern=".{5,30}"  maxlength="30" required="true" size="15" class="inputType"/>	
		<p>Jelszó megerősítése:</p> <input type="password" name="passwordConfirm"  maxlength="30" required="true" size="15" class="inputType"/>
		<p>Név:</p><input type="text" name="name" required="true" size="15" maxlength="50" class="inputType" />		
		<p>Bankszámlaszám:</p><input type="text" name="accountNumber" required="true" pattern=".{15,15}" maxlength="15" size="15" class="inputType" />			
		<p>E-mail cím:</p><input type="email" name="email" required="true" size="15"  maxlength="40" class="inputType" placeholder="valaki@valami.hu" />
		<p>Telefonszám:</p><input type="text" name="phoneNumber" required="true" size="15" placeholder="203411738" maxlength="9" class="inputType" />	
		
		<input type="submit" style="padding:10px; margin-top:15%;  width:230px;" value="Regisztráció" name="regist" class="buttonType"/>
	</form>
	</div>
	<div class="registerRules">
	<h3>Szabályok</h3>
	<ul>
		<li>A jelszó minimum 5, maximum 30 karakter lehet!</li>
		<li>A jelszónak tartalmaznia kell legalább egy nagybetűt, egy kisbetűt és egy számot!</li>
		<li>A telefonszámot +36 és 06 nélkül kell megadni!</li>
		<li>A bankszámlaszám 15 karakter hosszú kell, hogy legyen!</li>
	</ul> 

	</div>	
	</div>
	
	</body>
</html>