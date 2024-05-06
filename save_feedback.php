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
    
// Get data from POST request
$sessionID = $_POST["sessionID"];
$text = $_POST["text"];
$rating = $_POST["rating"];

// Prepare and execute INSERT query
$sql = "INSERT INTO review (sessionID, text, rating) VALUES ($sessionID, $text, $rating)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $sessionID, $text, $rating);
$stmt->execute();

// Check for successful insertion
if ($stmt->affected_rows > 0) {
  echo "Feedback saved successfully!";
} else {
  echo "Error saving feedback.";
}

$stmt->close();
$conn->close();

?>
