<?php
$dbServername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "linguist";
//include('linguist.sql');

    $conn = mysqli_connect($servername, $username, $password, $dbname);



    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    echo "Connected successfully";
    
    

