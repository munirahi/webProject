<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linguist";
//include('linguist.sql');

    $conn = mysqli_connect($servername, $username, $password, $dbname);



    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    echo "Connected successfully";
    
    

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Retrieve the submitted data
$rating = $_POST['rating'];
$description = $_POST['description'];

// Prepare and execute the SQL statement to insert the data
$sql = "INSERT INTO feedback_table (rating, description) VALUES (:rating, :description)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);
$stmt->execute();

// Check if the data was successfully inserted
if ($stmt->rowCount() > 0) {
    echo "Data saved successfully";
} else {
    echo "Error: Data not saved";
}

// Close the database connection
$pdo = null;
?>
