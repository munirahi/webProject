<?php
   // $conn = mysqli_connect($dbServername, $dbusername, $dbpassword, $dbName);
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
  // Redirect the user to the login page
  header("Location: php/login.php");
  exit(); // Stop further execution
}

//include("php/learnerhp.php");
include("php/ratet.php");
?>
   <!DOCTYPE html>
   <html>
   
   <head>
     <meta charset="UTF-8">
   
     <link rel="stylesheet" href="css/footer.css">
     <link rel="stylesheet" href="header_folder/headerPartner.css">
     <link rel="stylesheet" href="css/tutorRate.css">
     <script src="https://kit.fontawesome.com/59189109f7.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
      
      
       
       
       <title>Rates and Reviews</title>
   </head>

   <body>
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
  $today = date("Y-m-d");
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM session WHERE L_id='$user_id' AND Date= '$today'";
  $Result = mysqli_query($conn, $sql);
  $ResultCheck = mysqli_num_rows($Result);

  if ($ResultCheck > 0) {
  } else {
    echo '<script>console.log("not good!"); </script>';
  }
  ?>
  <?php




function displayallSessions()
  {
    // Include the database connection file
    include("php/connection.php");
    // Get the current date
    $currentDate = date('Y-m-d');
    $endDate =$currentDate;
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM session WHERE T_id='$user_id' AND Date  >= '$endDate';";
    $sesstions = mysqli_query($conn, $sql);

    // Check if there are any sessions for this week
    if (mysqli_num_rows($sesstions) > 0) {


      // Loop through the sessions and display each session card
      while ($row = mysqli_fetch_assoc($sesstions)) {
        $tutorId = $row['T_id'];
        $sql_tutor = "SELECT * FROM review WHERE  P_ID = '$tutorId';";
        $sesstions = mysqli_query($conn, $sql_tutor);
        if ($sesstions) {
          // Fetch the learner's name from the result set
          $learneRow = mysqli_fetch_assoc($sesstions);
        }

       
        echo '<div class="request-card">';
        echo '<div class="learner-info">';
        // Output learner's profile picture
        echo '<div class="day">';
        // Output learner's name
        echo '<p class="rating"><i class="fa-solid fa-star"></i> ' . (isset($learneRow['starts'])) . ' <i class="fa-solid fa-dollar-sign"></i> ' . (isset($row['ReviewText']) ? $row['ReviewText'] : 'N/A') . '</p>';
    
        echo '<h5><strong><i class="fa-solid fa-user"></i>'. $learneRow['ReviewText']. '</strong></h5>';

        // Output the day of the session
       

        // $flagImage = '<script>getFlagImage("' . $row['language'] . '")</script>' ;
        // echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
     
      }
    } else {
      // If no sessions are found, display a message
      echo '<h2>No rate found.</h2>';
    }
  }

  ?>
   </header>
   <div class="backg">
    
    
       
      
      
             <section class="box-content">

    

               <div class="containing-div">

                   <div class="request_div inner-div">
                     <h1 id="result-header">Your Ratings and Reviews!</h1>
          <div class="week-sesstoin">

            <div class="result-cell">
                      
              <div class="acc-info">
                  
              <?php displayallSessions(); ?>
              </div>
            </div></div></div></div></section></div>

      </div>     
     
        
      
   </main>


   <footer>
     <div class="main-content">
       <div class="left box">
         <h2>About us</h2>
         <div class="content">
           <p> Embark on a linguistic journey with LINGUIST. Connect with native speakers worldwide,
                hone your language skills through immersive experiences, and unlock new cultures from the comfort of your home.<a class="find-more" href="About_us_pageMain.html">Find more</a></p>
           <div class="social">
             <a href="#"><span class="fab fa-facebook-f"></span></a>
             <a href="#"><span class="fab fa-twitter"></span></a>
             <a href="#"><span class="fab fa-instagram"></span></a>
             <a href="#"><span class="fab fa-youtube"></span></a>
           </div>
         </div>
       </div>
   
       <div class="center box">
         <h2>Address</h2>
         <div class="content">
           <div class="place">
             <span class="fas fa-map-marker-alt"></span>
             <span class="text">Riyadh, KSA</span>
           </div>
           <div class="phone">
             <span class="fas fa-phone-alt"></span>
             <span class="text">+966-505432100</span>
           </div>
           <div class="email">
             <span class="fas fa-envelope"></span>
             <span class="text"><a href="mailto:content@linguist.com"></a>
               content@linguist.com</span>
           </div>
         </div>
       </div>
   
       <div class="right box">
         <h2>Contact us</h2>
         <div class="content">
           <form action="#" method="post">
             <div class="email">
               <div class="text">Email <span class="required">*</span></div>
               <input type="email" required>
             </div>
             <div class="msg">
               <div class="text">Message <span class="required">*</span></div>
               <textarea rows="2" cols="25" required></textarea>
             </div>
             <div class="btn">
               <button type="submit">Send</button>
             </div>
           </form>
         </div>
       </div>
     </div>
     <div class="bottom">
       <section>
         <span class="credit">Created By <a href="main.html">linguist</a> | </span>
         <span class="far fa-copyright"></span><span> 2024 All rights reserved.</span>
       </section>
     </div>
   </footer>
  </div>
  </div>
     </body>
   </html>
   
