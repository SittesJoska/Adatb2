<?php
   include "menu.html";
   session_start();
   
   unset($_SESSION["user"]);
   unset($_SESSION["pass"]);
   unset($_SESSION["passConfirm"]);
   unset($_SESSION["fullName"]);
   unset($_SESSION["accountNumber"]);
   unset($_SESSION["accountMoney"]);
   unset($_SESSION["email"]);
   unset($_SESSION["phoneNumber"]);
   

   session_destroy();
   
   echo '<div class="div3"><p>Kijelentkeztél...</p></div>';
   header('Refresh: 2; URL = index.php');
?>