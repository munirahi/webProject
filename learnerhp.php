<?php
$dbServername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "linguist";
    $ccon = mysqli_connect($dbServername, $dbusername, $dbpassword, $dbName);

    if (!$ccon) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    echo "Connected successfully";
    
    
    mysqli_close($ccon);

?>
