<?php
/* Set oracle user login and password info */
$dbuser = "SinterJóska";
$dbpass = "mk8h7a3";
$dbname = "xe";

$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
  
  $conn = oci_connect($dbuser, $dbpass, $tns, 'UTF8') or die();

if (!$conn)  {
    echo "An error occurred connecting to the database"; 
    exit; 
}

?>