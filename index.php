<html>
<head>
    <link rel=stylesheet type="text/css" href="mystyle.css" />
</head>
<body>
<?php

//putenv("PATH=F:\xampp\instantclient-basic-nt-12.1.0.2.0\instantclient_12_1");

$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
  
$conn = oci_connect('GÖBI', '123456', $tns,'UTF8') or die();
//$conn = oci_connect('GÖBI', '', 'localhost/xe') ;

/*
//// ---- PDO-s megoldás ----
$tns = "
     (DESCRIPTION =
         (ADDRESS_LIST =
             (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)) )
             (CONNECT_DATA = (SID = xe) ) )";
   $db_username = "HR";
   $db_password = "HR";
   try{
       $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
   }catch(PDOException $e){
        echo ($e->getMessage());
   }
*/

echo '<h2>Az Employees tábla adatai: </h2>';
echo '<table border="0">';


//// -- lekerdezzuk a tabla tartalmat
$stid = oci_parse($conn, 'SELECT * FROM BIZTOSITO');

oci_execute($stid);

//// -- eloszor csak az oszlopneveket kerem le
$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
}
echo '</tr>';

//// -- ujra vegrehajtom a lekerdezest, es kiiratom a sorokat
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

oci_close($conn);


?>
</body>
</html>
