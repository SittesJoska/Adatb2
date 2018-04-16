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
	<div class="loginDiv" style="margin-top:7%;">		
	<form method="post" action="regist.php">	
		<h2>Adatok</h2>
		<p>Felhasználónév:</p><input readonly type="text" name="username" required="true" size="15" maxlength="30" class="inputType" />			
		<p>Jelszó:</p> <input type="password" name="password" pattern=".{5,30}"  maxlength="30" required="true" size="15" class="inputType"/>	
		<p>Jelszó megerősítése:</p> <input type="password" name="passwordConfirm"  maxlength="30" required="true" size="15" class="inputType"/>
		<p>Név:</p><input readonly  type="text" name="name" required="true" size="15" maxlength="50" class="inputType" />		
		<p>Bankszámlaszám:</p><input type="text" name="accountNumber" required="true" pattern=".{15,15}" maxlength="15" size="15" class="inputType" />
		<p>Egyenleg:</p><input readonly type="text" name="accountMoney" required="true" size="15" class="inputType" />
		<br/>
		<input type="submit" style="padding:2px; margin:2%;  width:100px;" value="Feltölt" name="upload" class="buttonType"/>
		<p>E-mail cím:</p><input type="email" name="email" required="true" size="15"  maxlength="20" class="inputType" placeholder="valaki@valami.hu" />
		<p>Telefonszám:</p><input type="text" name="phoneNumber" required="true" size="15" placeholder="203411738" maxlength="9" class="inputType" />	
		
		<input type="submit" style="padding:10px; margin-top:15%;  width:230px;" value="Módosít" name="modify" class="buttonType"/>
	</form>
	
				
	</div>
	

	
	
	
  
  
  </body>
</html>
