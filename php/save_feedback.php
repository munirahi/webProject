<?php

session_start(); // Start a session (if needed)

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
$P_ID = $_POST["pid"];
// Check if session is set before accessing user ID

  $L_ID = $_SESSION['user_id'];
  
  
$sql = "INSERT INTO review (L_ID, starts, ReviewText, P_ID, sessionID) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisii", $L_ID, $rating, $text, $P_ID, $sessionID);

if (!$stmt->execute()) {
  echo "Error saving feedback: " . $stmt->error;
} else {
  echo "Feedback saved successfully!";
}

$stmt->close();
$conn->close();
?>
