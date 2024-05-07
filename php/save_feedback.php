<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linguist";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sessionID = $_POST["sessionID"];
$text = $_POST["text"];
$rating = $_POST["rating"];

$sql = "INSERT INTO review (sessionID, text, rating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $sessionID, $text, $rating);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo "Feedback saved successfully!";
} else {
  echo "Error saving feedback.";
}

$stmt->close();
$conn->close();
?>
