<?php 
// if(!isset($_SESSION['user_id'])){
// header("Location: php/login.php");


// }
session_start(); // Start the session

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: php/login.php");
    exit(); // Stop further execution
}

include("php/tutorsInfo.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Tutor Home</title>
    <link rel="stylesheet" type="text/css" href="css/css-for-tutor-home.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" type="text/css" href="css/sidebar-tutor.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="header_folder/headerPartner.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
<?php 
DEFINE('DB_user','root');
DEFINE('DB_PSWD','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','linguist');

if(!$conn = mysqli_connect(DB_HOST,DB_user,DB_PSWD,DB_NAME)){
  
  die("connection failed. ");
}
 

  if(!mysqli_select_db($conn,DB_NAME)){
    
    echo '<script>console.log(" no db!"); </script>'; 

    die("could not open the ".DB_NAME."database");
  }

?>
    
  </head>
  <script
    src="https://kit.fontawesome.com/5a18e3112f.js"
    crossorigin="anonymous"
  ></script>
  <body>

  <?php
  
// Get today's date
$today = date("Y-m-d");

$sql = "SELECT * FROM session WHERE Date= '$today'";
$Result = mysqli_query($conn,$sql);
$ResultCheck = mysqli_num_rows($Result);

if($ResultCheck > 0) {


} else {
  echo '<script>console.log("not good!"); </script>'; 
}

// $sqltutor = 


?>
    <header id="header">
      <div id="header-div">
        <nav class="fixed-top" id="main-nav">
          <ul id="ul1">
            <li>
              <img
                src="images/linguistBlueAndWhite.jpg"
                alt="LINGUIST logo"
                id="logo-img"
              />
            </li>
            <li class="list1-item">
              <a href="tutor_Home_page.html" class="list1-item">Home</a>
            </li>
            <li class="list1-item"><a href="SESSionTutor.html">Sessions</a></li>
            <li class="list1-item"><a href="tutorReq.html">Requests</a></li>
            <li class="list1-item">
              <a href="SupportsPartner.html">Support</a>
            </li>
          </ul>
          <ul id="ul2">
            <li id="acnt li">
              <nav id="account-nav">
                <img src="images/account.jfif" id="account-img" />
                <ul>
                  <li class="account-list">
                    <a href="EditProfileP.html"
                      ><div class="circle"></div>
                      Edit Profile</a
                    >
                  </li>

                  <li class="account-list">
                    <a href="#"
                      ><div class="circle"></div>
                      Log Out</a
                    >
                  </li>
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
            <img src="images/femaleIcon2.png" alt="Profile Picture" />
            <!-- <h2>Gloria Harold</h2> -->
            <h2><?php echo $firstname . ' ' . $lastname ?> </h2>
            <p id="bio"><?php echo $bio ?></p>
          </div>

          <div class="card-body">
            <ul class="stats">
              <li id="hours">
                <i class="fa-solid fa-clock"></i>
                <span>Total Hours of Teaching</span>
                <span><?php echo $totalHours ?></span>
              </li>
              <li id="earnings">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Total Earnings</span>
                <span>$<?php echo '1000'?></span>
              </li>
              <li id="Rating">
                <a href="toturRate.html" id="rating-anchor">
                  <i class="fa-solid fa-star"></i>
                  <span>Rating</span>
                  <span><?php echo $averageRating .'('. $totalReviews .'Ratings)'?></span>
                </a>
              </li>
              <li id="Languages">
                <span>Teaching Languages</span>
                <span>English, Spanish, French</span>
              </li>
              <li id="Cultural backgrounds">
                <span>Cultural backgrounds</span>
                <img class="flag" src="images/flag.png" alt="KSA" />
                <img class="flag" src="images/france.png" alt="French" />
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
                <hr />
                <i class="fa-solid fa-user"></i>
                <!-- add icons -->
                <a id="profile-settings" href="EditProfileP.html"
                  >Profile Settings</a
                >
              </li>
            </ul>
          </div>
        </div>
      </aside>

      <section class="center">
        <section class="sessions-day">
          <section name="current-sessions" class="current-sessions">
            <h3>Today's Sessions</h3>

            <section class="Today-sessions">


              <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="images/maleIcon3.png"
                    alt="current-session"
                  />
                  <div class="card-inner">
                    <h4><strong>Andrew Paul</strong></h4>
                    <section class="incard-elements-sessions">
                      <p class="language">
                        <img
                          class="flag"
                          src="images/france.png"
                          alt="French"
                        />
                        French
                      </p>
                      <p class="level">Beginner</p>
                      <p class="type">Discussion</p>
                      <p class="duration">10 Minutes</p>
                    </section>
                    <a class="enter-btn-current" href="#">Join</a>
                  </div>
                </div>
              </div>

                  <?php

                          while($row = mysqli_fetch_array($Result)) {
                            $learnerId = $row['L_id'];
                            $learnerQuery = "SELECT Firstname,Lastname,image FROM learner WHERE id = '$learnerId'";
                            $learnerResult = mysqli_query($conn, $learnerQuery);
                            if ($learnerResult) {
                              // Fetch the learner's name from the result set
                              $learnerRow = mysqli_fetch_assoc($learnerResult);}
                              $sessionStartTime = strtotime($row['Time']);
                              $sessionDuration = $row['Duration'];
                          
                              // Get the current time
                              $currentTime = time();
                          
                              // Calculate the end time of the session
                              $sessionEndTime = $sessionStartTime + ($sessionDuration * 60); // Convert duration to seconds
                          
                              // Check if the session has started and has not ended yet
                              if ($currentTime >= $sessionStartTime && $currentTime < $sessionEndTime) {
                                  // Session is ongoing, display "Join"
                                  $buttonText = "Join";
                                  $Button_color="enter-btn-current";
                              } elseif ($currentTime < $sessionStartTime) {
                                  // Session has not started yet, display the start time
                                  $buttonText = date("h:i A", $sessionStartTime);  // Format the start time as desired
                                  
                                  $Button_color="enter-btn";
                              } else {
                                  // Session has ended, display something else or hide the button
                                  $buttonText = "Session ended";
                                  $Button_color="enter-btn-done" ;
                              }
                            ?>
                             <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src=<?php echo  $learnerRow['image']?>
                    alt="current-session"
                  />    <!-- <?php echo  $learnerRow['image']?> "images/femaleIcon3.png" -->
                           <?php echo '<script>console.log(" good!"); </script>'; ?>
                             <div class="card-inner">
                             <h4><strong><?php echo $learnerRow['Firstname'].' '.  $learnerRow['Lastname']?></strong></h4>
                           <section class="incard-elements-sessions">
                           <p class="language"><?php echo $row['language'] ?></p>
                           <p class="level"><?php echo $row['level'] ?></p>
                           <p class="time"><?php echo $row['Time']  ?>
                            <p class="duration"><?php echo $row['Duration']?> Minutes</p>
                          </section>
                           <a class="<?php echo $Button_color ?>" href="#" ><?php echo $buttonText ?></a>
                          </div>
                </div>
                             </div>
                            <?php
                          }
                      ?>


              <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="images/femaleIcon3.png"
                    alt="current-session"
                  />
                  <div class="card-inner">
                    <h4><strong>Olivia Andrew </strong></h4>
                    <section class="incard-elements-sessions">
                      <p class="language">
                        <img
                          class="flag"
                          src="images/france.png"
                          alt=" French"
                        />
                        French
                      </p>
                      <p class="level">Advanced</p>
                      <p class="type">Session</p>
                      <p class="duration">20 Minutes</p>
                    </section>
                    <a class="enter-btn" href="#">3:30 PM</a>
                  </div>
                </div>
              </div>
              <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="images/maleIcon.png"
                    alt="current-session"
                  />
                  <div class="card-inner">
                    <h4><strong>Larry Scott</strong></h4>
                    <section class="incard-elements-sessions">
                      <p class="language">
                        <img
                          class="flag"
                          src="images/france.png"
                          alt=" French"
                        />
                        French
                      </p>
                      <p class="level">Advanced</p>
                      <p class="type">Session</p>
                      <p class="duration">30 Minutes</p>
                    </section>
                    <a class="enter-btn" href="#">5:30 PM</a>
                  </div>
                </div>
              </div>
              <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="images/maleIcon2.png"
                    alt="current-session"
                  />
                  <div class="card-inner">
                    <h4><strong>Keith Walter</strong></h4>
                    <section class="incard-elements-sessions">
                      <p class="language">
                        <img
                          class="flag"
                          src="images/france.png"
                          alt="French"
                        />
                        French
                      </p>
                      <p class="level">Advanced</p>
                      <p class="type">Session</p>
                      <p class="duration">30 Minutes</p>
                    </section>
                    <a class="enter-btn" href="#">6:00 PM</a>
                  </div>
                </div>
              </div>
            </section>
          </section>
          <!--  -->
        </section>

        <section class="sessions">
          <h3>This Week's Sessions</h3>
          <br />
          <section class="week-sesstoin">
            <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon2.png" alt="profile Picture" />

                <div class="day">
                  <h5><strong>Tom Jefry</strong></h5>
                  <p class="day-of-upcoming-sesstions">Tomrrow</p>
                </div>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French
                </p>
                <p class="level">Beginner</p>
                <p class="type">Session</p>
                <p class="duration">30 Minutes</p>
              </section>
            </div>
            <div class="request-card">
              <div class="learner-info">
                <img src="images/femaleIcon2.png" alt="profile Picture" />

                <div class="day">
                  <h5><strong>Amy Ralph</strong></h5>
                  <p class="day-of-upcoming-sesstions">Tomrrow</p>
                </div>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French
                </p>
                <p class="level">Advanced</p>
                <p class="type">Session</p>
                <p class="duration">30 Minutes</p>
              </section>
            </div>

            <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon3.png" alt="profile Picture" />

                <div class="day">
                  <h5><strong>Jeff Duff</strong></h5>
                  <p class="day-of-upcoming-sesstions">Sunday</p>
                </div>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French
                </p>
                <p class="level">Beginner</p>
                <p class="type">Session</p>
                <p class="duration">30 Minutes</p>
              </section>
            </div>
          </section>

          <a href="SESSionTutor.html">
            <button class="view-more-button">View All Sessions</button></a
          >
        </section>
        <section class="new-requests-container">
          <h3>New Requests</h3>
          <br />
          <section class="requests">
            <section class="container  px-2">
    
             
              <div class="table-responsive">
              <table class="table table-responsive table-borderless">
                  
                <thead>
                  <tr class="bg-light">
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="20%">Date</th>
                    <th scope="col" width="10%">Status</th>
                    <th scope="col" width="20%">learner name</th>
                    <th scope="col" width="20%">language</th>
                    <th scope="col" class="text-end" width="20%"><span>Level</span></th>
                  </tr>
                </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>1 Oct, 21</td>
                <td><i class="fa fa-dot-circle-o yellow"></i><span class="ms-1">Pending</span></td>
                <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Althan Travis</td>
                <td><img src="images/united-states.png" width="20">English</td>
                <td class="text-end"><span class="fw-bolder">Advanced</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
              </tr>
              
              <tr>
                <td>2</td>
                <td>12 Oct, 21</td>
                <td><i class="fa fa-dot-circle-o text-danger"></i><span class="ms-1">Rejected</span></td>
                <td><img src="https://i.imgur.com/nmnmfGv.png" width="25"> Tomo arvis</td>
                <td><img src="images/united-states.png" width="20">English</td>
                <td class="text-end"><span class="fw-bolder">Advanced</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
              </tr>
              
              
              <tr>
                <td>3</td>
                <td>1 Nov, 21</td>
                <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Accepted</span></td>
                <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Althan Travis</td>
                <td><img src="images/united-states.png" width="20">English</td>
                <td class="text-end"><span class="fw-bolder">Beginner</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
              </tr>
              
              
              <tr>
                
                <td>4</td>
                <td>19 Oct, 21</td>
                <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Accepted</span></td>
                <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Travis head</td>
                <td><img src="images/united-states.png" width="20">English</td>
                <td class="text-end"><span class="fw-bolder">Advanced</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
              </tr>
              
              
              <tr>
                <td>5</td>
                <td>1 Oct, 21</td>
                <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Accepted</span></td>
                <td><img src="https://i.imgur.com/nmnmfGv.png" width="25"> Althan Travis</td>
                <td><img src="images/united-states.png" width="20">English</td>
                <td class="text-end"><span class="fw-bolder">Beginner</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
              </tr>
              </tbody>
             </table>
            
            </div>
              
          </section>












            <!-- <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon3.png" alt="profile Picture" />
                <h5><strong> Tom Jefry</strong></h5>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img
                    class="flag"
                    src="images/france.png"
                    alt="French"
                  />French
                </p>
                <p class="level">Beginner</p>
                <p class="type">Discussion</p>
                <p class="duration">30 Minutes</p>
              </section>
            </div>
            <div class="request-card">
              <div class="learner-info">
                <img src="images/femaleIcon3.png" alt="profile Picture" />
                <h5><strong>Ann Philip</strong></h5>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img
                    class="flag"
                    src="images/united-states.png"
                    alt="united-states"
                  />
                  English
                </p>
                <p class="level">Advanced</p>
                <p class="type">Session</p>
                <p class="duration">60 Minutes</p>
              </section>
            </div>
            <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon2.png" alt="profile Picture" />
                <h5><strong>Kevin Mark</strong></h5>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img
                    class="flag"
                    src="images/united-states.png"
                    alt="united-states"
                  />
                  English
                </p>
                <p class="level">Beginner</p>
                <p class="type">Session</p>
                <p class="duration">30 Minutes</p>
              </section>
            </div>
            <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon.png" alt="profile Picture" />
                <h5><strong>Dylan Mark</strong></h5>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  English
                </p>
                <p class="level">Intermediate</p>
                <p class="type">Session</p>
                <p class="duration">60 Minutes</p>
              </section>
            </div>
            <div class="request-card">
              <div class="learner-info">
                <img src="images/maleIcon2.png" alt="profile Picture" />
                <h5><strong>Joe Judy</strong></h5>
              </div>

              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  English
                </p>
                <p class="level">Intermediate</p>
                <p class="type">Session</p>
                <p class="duration">60 Minutes</p>
              </section>
            </div> -->
          </section><!-- end of requests -->
          <a href="tutorReq.html">
            <button class="view-more-button">View All Requests</button></a
          >
        </section> <!-- end of requests cotainer -->
      </section>
    </section>

    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>
              Embark on a linguistic journey with LINGUIST. Connect with native
              speakers worldwide, hone your language skills through immersive
              experiences, and unlock new cultures from the comfort of your
              home.<a class="find-more" href="About_us_pageMain.html"
                >Find more</a
              >
            </p>
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
              <span class="text"
                ><a href="mailto:content@linguist.com">content@linguist.com</a>
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
                <input type="email" required />
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
          <span class="credit"
            >Created By <a href="main.html">linguist</a> |
          </span>
          <span class="far fa-copyright"></span
          ><span> 2024 All rights reserved.</span>
        </section>
      </div>
    </footer>
  </body>
</html>
<?php
mysqli_close($conn);
?>
