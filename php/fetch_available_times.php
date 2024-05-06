<?php
// Include your database connection file
include 'connection.php';

// Check if the date parameter is set
if(isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Fetch available times for the selected date from the database
    $sql = "SELECT Time FROM  available_times WHERE Date = '$selectedDate' AND availability = 1";
    $result = mysqli_query($conn, $sql);

    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        // Initialize an array to store available times
        $availableTimes = array();

        // Fetch data and store available times in the array
        while ($row = mysqli_fetch_assoc($result)) {
            // Add the time to the availableTimes array
            $availableTimes[] = $row['Time'];
        }

        // Convert the array to JSON format and echo it
        echo json_encode($availableTimes);
    } else {
        // If no rows are returned, echo an empty array
        echo json_encode(array());
    }
} else {
    // If the date parameter is not set, return an error
    echo json_encode(array('error' => 'Date parameter is missing'));
}

// Close the database connection
mysqli_close($conn);
?>
