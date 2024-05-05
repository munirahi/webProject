<?php

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

// Connect to your database (assuming you have a function to establish a database connection)
include("connection.php");

// Fetch the name of the tutor based on the user ID stored in the session
$user_id = $_SESSION['user_id'];

// Query to fetch the name based on the user ID
$sql = "SELECT * FROM tutor WHERE ID = '$user_id';";
$result = mysqli_query($conn, $sql);
$tutorsSessionsQuery = "SELECT * FROM session WHERE T_id = '$user_id';";
$tutorReviewsQuery ="SELECT starts FROM review WHERE P_ID  = '$user_id';";
// Execute the query
$tutorsSessionsResult = mysqli_query($conn, $tutorsSessionsQuery);
$tutorReviewsResult = mysqli_query($conn, $tutorReviewsQuery);

$tutorsLagsQuery ="SELECT * FROM tutor_languages WHERE P_ID = '$user_id'";
$tutorsLagsResult=mysqli_query($conn, $tutorsLagsQuery);

$totalHours = 0;
$totalStars =0;
$totalReviews =0;
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the name from the result set
    $row = mysqli_fetch_assoc($result);
    $firstname = $row['Firstname'];
    $lastname = $row['Lastname'];
    $email = $row['Email'];
    $phone = $row['PhoneNumber'];
    $bio = $row['bio'];
    $experience = $row['experience'];
    $eduction = $row['eduction'];
    $image=$row["image"];


} else {
    // Handle the case where the user ID is not found in the database
    echo "<h1>Error: User not found</h1>";
}


// Check if there are any sessions for the tutor
if (mysqli_num_rows($tutorsSessionsResult) > 0) {
    // Loop through each session record
    while ($sessionRow = mysqli_fetch_assoc($tutorsSessionsResult)) {
        // Add the duration of the session to the total hours
        $totalHours += $sessionRow['Duration'] / 60;
    }

}
if (mysqli_num_rows($tutorReviewsResult) > 0) {
    // Loop through each session record
    while ($ReviewsRow = mysqli_fetch_assoc($tutorsSessionsResult)) {
        // Add the duration of the session to the total hours
        $totalStars += $ReviewsRow['starts'];
        $totalReviews++;
    }
    if ($totalReviews > 0) {
        $averageRating = $totalStars / $totalReviews;
    } else {
        // Handle the case where there are no reviews
        $averageRating = 0; // or any default value you prefer
    }

}
$tutorLanguages =array();

if ($tutorsLagsResult && mysqli_num_rows($tutorsLagsResult) > 0) {
    // Fetch the name from the result set
    while ($tutorsLags = mysqli_fetch_assoc($tutorsLagsResult)) {
        // Add the language to the array
        $tutorLanguages[] = $tutorsLags['Language'];
    }
}
// find newest requests 

// $sqlForreq = "SELECT * FROM request WHERE Status='Pending' And P_ID = '$user_id';";
// $resultForreq = mysqli_query($conn, $sqlForreq);

// include('flag.php');

// Function to retrieve requests with the closest date to the current date
function getClosestDateRequests() {
    $user_id = $_SESSION['user_id'];
    include("connection.php");
    $sqlForClosestDate = "SELECT * FROM request WHERE Status='Pending' AND P_ID = '$user_id' ORDER BY Date ASC LIMIT 5;";
    $resultForClosestDate = mysqli_query($conn, $sqlForClosestDate);

    // Check if there are rows returned
    if(mysqli_num_rows($resultForClosestDate) > 0) {
        
        // Loop through the results and display each request
        while($row = mysqli_fetch_assoc($resultForClosestDate)) {

            $learner_id = $row['L_ID'];
            $sqlLearner = "SELECT * FROM learner WHERE ID = '$learner_id'";
            $resultLearner = mysqli_query($conn, $sqlLearner);
            if(mysqli_num_rows($resultLearner) > 0) {
                $learnerData = mysqli_fetch_assoc($resultLearner);
                $learner_name = $learnerData['Firstname'] . ' ' . $learnerData['Lastname'];
                $lImage = $learnerData['image'];
            } else {
                $learner_name = "Unknown"; // Default value if learner is not found
            }

            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            echo '<img src="images/'.$lImage.'" alt="profile Picture">';
            echo '<h5><strong>'.$learner_name.'</strong></h5>';
            echo '</div>';

            echo '<section class="incard-elements">';
            // Display request details getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="'.getFlagImage($row['Language']).'" alt="flag">'.$row['Language'].'</p>'; 
            echo '<p class="level">'. $row['Level']. '</p>'; 
            echo '<p class="Date">' . $row['Date'] . '</p>'; 
            echo '<p class="duration">'.$row['Duration'].' Minutes</p>'; 
            echo '</section>';
            
            echo '</div>';
        }
        
    } else {
        echo "No pending requests found.";
    }
}

// Function to retrieve all pending requests
function getAllPendingRequests($conn, $user_id) {
    $sqlForAllPending = "SELECT * FROM request WHERE Status='Pending' AND P_ID = '$user_id';";
    $resultForAllPending = mysqli_query($conn, $sqlForAllPending);

    // Check if there are rows returned
    if(mysqli_num_rows($resultForAllPending) > 0) {
          // Loop through the results and display each request
          while($row = mysqli_fetch_assoc($resultForAllPending)) {

            $learner_id = $row['L_ID'];
            $sqlLearner = "SELECT * FROM learner WHERE ID = '$learner_id'";
            $resultLearner = mysqli_query($conn, $sqlLearner);
            if(mysqli_num_rows($resultLearner) > 0) {
                $learnerData = mysqli_fetch_assoc($resultLearner);
                $learner_name = $learnerData['Firstname'] . ' ' . $learnerData['Lastname'];
                $lImage = $learnerData['image'];
            } else {
                $learner_name = "Unknown"; 
            }

            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            echo '<img src="images/'.$lImage.'" alt="profile Picture">';
            echo '<h5><strong>'.$learner_name.'</strong></h5>'; 
            echo '</div>';
            
            echo '<section class="incard-elements">';
            // Display request details getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="'.getFlagImage($row['language']).'" alt="flag">'.$row['Language'].'</p>'; 
            echo '<p class="level">'. $row['Level']. '</p>'; 
            echo '<p class="Date">' . $row['Date'] . '</p>'; 
            echo '<p class="duration">'.$row['Duration'].' Minutes</p>'; 
            echo '</section>';
            
            echo '</div>';}
    } else {
        echo "No pending requests found.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
