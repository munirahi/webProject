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
$tutorReviewsQuery ="SELECT * FROM review WHERE P_ID  = '$user_id';";
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
        $totalStars += $ReviewsRow['stars'];
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
// Close the database connection
mysqli_close($conn);
?>
