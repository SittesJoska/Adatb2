<?php
   include "menu.html";
   session_start();
   
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();
   
   echo '<div class="div3"><p>Kijelentkeztél...</p></div>';
   header('Refresh: 2; URL = index.php');
?>