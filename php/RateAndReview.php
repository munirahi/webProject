<?php
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

include("learnerInfo.php");

// rate.php

if (isset($_GET['sessionID']) && isset($_GET['teacherID'])) {
    $sessionID = $_GET['sessionID'];
    $teacherID = $_GET['teacherID'];

    // Display the rating form or perform any other necessary operations
    // ...
}
?>
<!DOCTYPE html>
<html>

<head>

   
  <meta charset="utf-8" />
  <title>rating</title>
  <link rel="stylesheet" type="text/css" href="../css/SessionLearner.css" />
  <link rel="stylesheet" href="../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/sidebar-tutor.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="../header_folder/headerPartner.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/footer.css" />
  <link rel="stylesheet" href="../css/Support.css" />
  <!-- icons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<script src="https://kit.fontawesome.com/5a18e3112f.js" crossorigin="anonymous"></script>

<body>
  
  <header id="header">
    <div id="header-div">
      <nav class="fixed-top" id="main-nav">
        <ul id="ul1">
          <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo" id="logo-img"></li>
          <li class="list1-item"><a href="HomePageLearner.php" class="list1-item">Home</a></li>
          <li class="list1-item"><a href="SESSionLearner.php">Sessions</a></li>
          <li class="list1-item"><a href="learnerRequest2.php">Requests</a></li>
          <li class="list1-item"><a href="RateAndReview.php">Rate and Review</a></li>
          <li class="list1-item"><a href="Supports.php">Support</a></li>
        </ul>
        <ul id="ul2">

          <li id="acnt li">
            <nav id="account-nav"><img src="uploads/<?php echo $newImageName; ?>" id="account-img">
              <ul>

                <li class="account-list"><a href="EditProfile.php">
                    <div class="circle"></div>Edit Profile
                  </a></li>

                <li class="account-list"><a href="logout.php">
                    <div class="circle"></div>Log Out
                  </a></li>
              </ul>

            </nav>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <?php
function getFlagImage($language) {
    // Define a map of language names to flag image directories
    $languageFlags = array(
        "French" => "france.png",
        "German" => "germanyy.png",
        "English" => "united-states.png",
        "Arabic" => "flag.png"
        // Add more language-flag mappings as needed
    );

    // Check if the provided language is in the map
    if (array_key_exists($language, $languageFlags)) {
        // Return the corresponding flag image directory
        return "images/" . $languageFlags[$language];
    } else {
        // If the language is not found, return a default flag image
        return "images/default-flag.png";
    }
}
function saveFeedback() {
    // Include the database connection file
    include("connection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the form data
        $session_id = $_POST['session_id'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];

        // Perform any necessary validation on the form data

        // Prepare the SQL statement to insert the feedback into the database
        $sql = "INSERT INTO review (L_ID, sessionID, starts, ReviewText) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'iiis', $_SESSION['user_id'], $session_id, $rating, $review);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Feedback successfully saved
            echo "Feedback saved successfully.";
        } else {
            // Failed to save feedback
            echo "Error saving feedback: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Call the saveFeedback() function to handle the form submission

function displaySessions() {
    // Include the database connection file
    include("connection.php");

    // Get the current date
    $currentDate = date('Y-m-d');
    $endDate = $currentDate;
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM session WHERE L_id='$user_id' AND Date >='$endDate';";
    $sessions = mysqli_query($conn, $sql);

    // Check if there are any sessions for this week
    if (mysqli_num_rows($sessions) > 0) {
        // Loop through the sessions and display each session card
        while ($row = mysqli_fetch_assoc($sessions)) {
            $tutorId = $row['T_id'];
            $sql_tutor = "SELECT * FROM tutor WHERE id = '$tutorId';";
            $result_tutor = mysqli_query($conn, $sql_tutor);
            if ($result_tutor) {
                // Fetch the tutor's information from the result set
                $tutorRow = mysqli_fetch_assoc($result_tutor);
            }

            $dayOfWeek = date('l', strtotime($row['Date']));
            if ($currentDate == $row['Date']) {
                continue;
            }

            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            // Output tutor's profile picture
            echo '<img src="images/' . $tutorRow['image'] . '" alt="profile Picture" />';
            echo '<div class="day">';
            // Output tutor's name
            echo '<h5><strong>' . $tutorRow['Firstname'] . ' ' . $tutorRow['Lastname'] . '</strong></h5>';
            // Output the day of the session
            echo '<p class="day-of-upcoming-sessions">' . $dayOfWeek . '</p>';
            echo '</div></div>';
            echo '<section class="incard-elements">';
            // Output session details
            $flagImage = getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
            echo '<p class="level">' . $row['level'] . '</p>';
            echo '<p class="type">' . date("h:i A", strtotime($row['Time'])) . '</p>';
            echo '<p class="duration">' . $row['Duration'] . ' Minutes</p>';
            echo '</section></div>';
        }
    } 
}
?>

        <?php
        displaySessions();
        saveFeedback();

        ?><br><br><br>
         <h2>Rates and Reviews</h2>
    </div>

    <section class="week-sesstoin">
      <br><br><br>
      <div class="request-card">
       
        <form method="POST" action="SESSionLearner.php">
            <div class="form-group">
             <br>   <label for="session_id">Session ID:</label><br>
                <input type="text" name="session_id" id="session_id" required>
            </div>
            <div class="form-group"><br><br>
             <label for="rating">Rating (1-5):</label><br>
                <input type="number" name="rating" id="rating" min="1" max="5" required>
           
            <div class="form-group"><br>
                <label for="review">Review:</label>
               <br><br><br> <textarea name="review" id="review" rows="5" ></textarea>
            </div>
            <input type="submit" value="Submit">
        
        </form>
    </section>
      </div></section>
</body>
</html>
