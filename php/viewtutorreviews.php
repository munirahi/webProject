<?php
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit(); 
}
$pid = isset($_GET['pid']) ? $_GET['pid'] : null;

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Rest of the code to retrieve and display sessions
    displayAllSessions($pid);
} else {
    echo '<h2>Error: No tutor ID specified.</h2>';
}

include("ratet.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../header_folder/headerLearner.css">
  <script src="https://kit.fontawesome.com/59189109f7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="../css/tutorRate.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rates and Reviews</title>
</head>

<header id="header">
  <div id="header-div">
    <nav class="fixed-top" id="main-nav">
      <ul id="ul1">
        <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo" id="logo-img"></li>
        <li class="list1-item"><a href="HomePageLearner.php" >Home</a></li>
        <li class="list1-item"><a href="SESSionLearner.php">Sessions</a></li>
        <li class="list1-item"><a href="learnerRequest2.php">Requests</a></li>
        <li class="list1-item"><a href="Supports.php">Support</a></li>
      </ul>
      <ul id="ul2">
        <li id="acnt li">
          <nav id="account-nav"><img src="../images/<?php echo  $image?>" id="account-img">
            <ul>
              <li class="account-list"><a href="EditProfile.php"><div class="circle"></div>Edit Profile</a></li>
              <li class="account-list"><a href="logout.php"><div class="circle"></div>Log Out</a></li>
            </ul>
            <ul>
        </nav>
      </li>
      </ul>
    </nav>
  </div>
</header>

<body>
  <?php
  function displayAllSessions($pid)
  {
    include("connection.php");
    $sql = "SELECT starts, ReviewText FROM review WHERE P_id = '$pid' ";
    $sessions_result = mysqli_query($conn, $sql);

    // Check if there are any sessions for this tutor
    if (mysqli_num_rows($sessions_result) > 0) {
      // Loop through the sessions and display each session card
      while ($session_row = mysqli_fetch_assoc($sessions_result)) {
        $stars = $session_row['starts'];
        $reviewText = $session_row['ReviewText'];

        // Output the session card HTML
        echo '<div class="result-cell">';
        echo ' <div class="acc-info">';
        // Output the session details
        echo '<p class="rating"><i class="fa-solid fa-star"></i> ' . $stars . '</p>';
        echo '<p>' . $reviewText . '</p>';
        // Output other session information (e.g., day, language, etc.)
        echo '</div>'; // Close the learner-info div
        echo '</div>'; // Close the request-card div
      }
    } else {
      // If no sessions are found, display a message
      echo '<h2>No ratings found.</h2>';
    }
  }
  ?>


  <div class="backg">
    <section class="box-content">
      <div class="containing-div">
        <div class="request_div inner-div">
          <h1 id="result-header">Rate and Review!</h1>
          <div class="week-sessions">
            <?php
            displayAllSessions($pid);
            ?>
          </div>
        </div>
