<?php
session_start(); // Start the session
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}


include("learnerhp.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Learner Home</title>
    <link rel="stylesheet" type="text/css" href="css/HomePageLearner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/sidebar-tutor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="header_folder/headerPartner.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
</head>
<script src="https://kit.fontawesome.com/5a18e3112f.js" crossorigin="anonymous"></script>
<body>
 
<?php
function displayThisWeekSessions() {
  include("php/connection.php");
$currentDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('+7 days'));
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM session WHERE L_id='$user_id' AND Date BETWEEN '$currentDate' AND '$endDate';";
$weeksesstions = mysqli_query($ccon,$sql);
  if (mysqli_num_rows($weeksesstions) > 0) {
       while ($row = mysqli_fetch_assoc($weeksesstions)) {
        $tutorId = $row['T_id'];
        $sql_learner = "SELECT * FROM tutor WHERE  id = '$tutorId';";
        $learnThisWeek = mysqli_query($ccon, $sql_learner);
        if ($learnThisWeek) {
          $learnRow = mysqli_fetch_assoc($learnThisWeek);}
        $dayOfWeek = date('l', strtotime($row['Date']));
if($currentDate == $row['Date']){
continue;
}
          echo '<div class="request-card">';
          echo '<div class="learner-info">';
          // Output learner's profile picture
          echo '<img src="images/' . $learnRow['image'] . '" alt="profile Picture" />';

          echo '<div class="day">';
          // Output learner's name
          echo '<h5><strong>' . $learnRow['Firstname'].' '.  $learnRow['Lastname'] . '</strong></h5>';
          // Output the day of the session
          echo '<p class="day-of-upcoming-sessions">' . $dayOfWeek . '</p>';
          echo '</div></div>';
          echo '<section class="incard-elements">';
          // Output session details "' . getFlagImage($row['language']) . '"
          $flagImage =getFlagImage($row['language']);
          echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
          

          // $flagImage = '<script>getFlagImage("' . $row['language'] . '")</script>' ;
          // echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
          echo '<p class="level">' . $row['level'] . '</p>';
          echo '<p class="type"> '.  date("h:i A", strtotime($row['Time'])). '</p>';
          echo '<p class="duration">' . $row['Duration'] . ' Minutes</p>';
          echo '</section></div>';
      }
  } else {
      // If no sessions are found, display a message
      echo '<h2>No sessions scheduled for this week.</h2>';
  }

}

?>

  <header id="header">
    <div id="header-div">
    <nav class="fixed-top" id="main-nav">
        <ul id="ul1">
          <li><img src="images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img" ></li>
          <li class="list1-item"><a href="HomePageLearner.html" class="list1-item">Home</a></li>
          <li class="list1-item"><a href="SESSionLearner.html">Sessions</a></li>
          <li class="list1-item" ><a href="learnerRequest2.html">Requests</a></li>
          <li class="list1-item"><a href="RateAndReview.html">Rate and Review</a></li>
          <li class="list1-item"><a href="Supports.html">Support</a></li>
        </ul>
        <ul id="ul2">
            
            <li id="acnt li">
                <nav id="account-nav"><img src="images/account.jfif" id="account-img">
                    <ul>
                        
                        <li class="account-list"><a href="EditProfile.html"><div class="circle"></div>Edit Profile</a></li>
                        
                        <li class="account-list"><a href="#"><div class="circle"></div>Log Out</a></li>
                    </ul>

                </nav>
            </li>
        </ul>
    </nav>
</div>
 </header>
    <section class="continer">


            
            <aside class="sidebar">
                
                    <div class="sidebar-card">
                        <div class="card-body-profile">
                            <img src="images/femaleIcon.png" alt="Profile Picture">
                            <h2>Rebecca Smith</h2>
                            <p id="bio">English is easy, start today!</p>
                        </div>
                    
                     
                        <div class="card-body">
                        
                            <ul class="stats">
                                <li id="hours">
                                  <i class="fa-solid fa-clock"></i>
                                    <span>Total Hours of Studying</span>
                                    <span>100</span>
                                </li>
                                <li id="earnings">
                                  <i class="fa-solid fa-fire"></i></i>
                                    <span>Streak</span>
                                    <span>12 Days</span>
                                </li>
                                <li id="Rating">
                                  <i class="fa-solid fa-bars-progress"></i>
                                      
                                        <span>Progress</span>
                                    </a>
                                    <span>57%</span>
                                </li>
                                <li id="Languages">
                                    <span>Learning Languages</span>
                                    <span>English, Spanish, French</span>
                                </li>
                                <li id="Cultural backgrounds">
                                  <span>Cultural backgrounds</span>
                                  <img class="flag" src="images/united-states.png" alt="USA">
                              <img class="flag" src="images/france.png" alt="French">
                                </li>
                                <li>
                                    <span>Achievements</span>
                                    <span>
                                      <i class="fa-solid fa-gift"></i>
                                      <i class="fa-solid fa-handshake"></i>
                                        <!-- Add more achievements as needed -->
                                    </span>
                                </li>

                                <li>
                                  <hr>
                                  <i class="fa-solid fa-user"></i>
                                  <!-- add icons -->
                                  <a id="profile-settings" href="EditProfile.html">Profile Settings</a>
                                </li>
                                
                              
                            </ul>
                        </div>
                    </div>
            </aside>  
                
            <section class="center">
              <section class="sessions">
                <section class="request-post">
                  <h3>Let's Get Started!</h3>
                  <p>Start posting requests to find the perfect language learning partner!</p>
                <a href="learnerRequest2.html"><button>Post Request</button></a>
                  

                </section>   
              </section>
              <section class="sessions">
    <h3>This Week's Sessions</h3>
    <br>
   
     <?php          
     $ended_Sessions =array();

  // $sql = "SELECT * FROM session;"; // Assuming you have a "session" table
  // $result = mysqli_query($ccon, $sql);
   // $resultCheck = mysqli_num_rows($result);
    
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
         
            $lrearnerId = $row['learner_id'];
            $lQuery = "SELECT Firstname, Lastname, image FROM session WHERE L_id = '$learnerId'";
            $lResult = mysqli_query($conn, $lQuery);
            $lRow = mysqli_fetch_assoc($lResult);

            if (date('W', $sessionStartTime) == date('W') && date('Y', $sessionStartTime) == date('Y')) {
                ?>
                <div class="request-card">
                    <div class="learner-info">
                        <img src="images/maleIcon2.png" alt="profile Picture">
                        <div class="day">
                            <p class="day-of-upcoming-sessions"><?php echo date("l, F j, Y", $sessionStartTime); ?></p>
                        </div>
                    </div>
                    <section class="incard-elements">
                        <p class="language">
                            <img class="flag" src="images/france.png" alt="French"> <?php echo $row['language']; ?>
                        </p>
                        <p class="type">Session</p>
                        <p class="tutor-name"><?php echo $tRow['Firstname'] . ' ' . $tRow['Lastname']; ?></p>
                        <img class="tutor-image" src="<?php echo $tRow['image']; ?>" alt="Tutor Image">
                        <button class="<?php echo $Button_color; ?>"><?php echo $buttonText; ?></button>
                    </section>
                </div>
                <?php
            }
        }
    }
    ?>
</section>

              
               <div class="current-sessions-card">
  <div class="carousel-cell">
    <img class="current-session-img">
       <a href="SESSionTutor.html"> <button class="view-more-button">View All Sessions</button></a>
     </class>

                </section>
             
  
                <section class="new-requests-container">
                    <h3>Recommended Partners </h3>
                    <br>
                    <section class="requests">
                        
                            <div class="request-card">
                              <div class="learner-info">
                              <?php
                              $query = "SELECT * FROM review WHERE star >= 4";
  $result = mysqli_query($ccon, $query);

  // Check if there are any recommended partners
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // Display partner information
      echo '<div class="request-card">';
      echo '<div class="learner-info">';
      echo '<img src="images/' . $row['profile_picture'] . '" alt="profile Picture">';
      echo '<h6><strong><i class="fa-solid fa-user"></i>' . $row['partner_name'] . ' <i class="fa-solid fa-star"></i> ' . $row['star'] . ' <i class="fa-solid fa-dollar-sign"></i> ' . $row['rate'] . '</strong></h6>';
      echo '</div>';
      echo '<section class="incard-elements">';
      echo '<div class="bio"><p>' . $row['bio'] . '</p></div>';
      echo '</section>';
      echo '<div id="part-rec-post"><button>Post Request</button></div>';
      echo '</div>';
    }
  } else {
    // No recommended partners found
    echo '<p>No recommended partners available.</p>';
  }

  mysqli_close($ccon);
  ?>
                    </section>
                    <a href="learnerRequest2.html"> <button class="view-more-button">View More Partners</button></a>

                </section>

            </section>
             

    </section>

            
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
              <span class="text"><a href="mailto:content@linguist.com">content@linguist.com</a>
                </span>
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
</body>

</html>
