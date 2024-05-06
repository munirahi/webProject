<?php
include('php/connection.php');

// Check if the P_id query parameter is set
if(isset($_GET['ID'])) {
    // Get the selected tutor ID
    $selectedTutorId = $_GET['ID'];
    
    // Prepare the SQL query
    $sqlT = "SELECT * FROM tutor WHERE ID = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sqlT);
    
    // Bind the parameter to the placeholder
    mysqli_stmt_bind_param($stmt, "i", $selectedTutorId);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    // Check if there are rows returned
    if(mysqli_num_rows($result) > 0) {
        // Fetch the data as an associative array
        $tutorData = mysqli_fetch_assoc($result);
        
        // Access the fetched data
        $email = $tutorData['Email'];
        $image = $tutorData['image'];
        $firstname = $tutorData['Firstname'];
        $lastname = $tutorData['Lastname'];
        $age = $tutorData['age'];
        $gender = $tutorData['gender'];
        $password = $tutorData['password'];
        $phoneNumber = $tutorData['PhoneNumber'];
        $city = $tutorData['city'];
        $bio = $tutorData['bio'];
        $experience = $tutorData['experience'];
        $education = $tutorData['eduction'];
    } else {
        echo "No tutor found with ID: $selectedTutorId";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Default content if no id is selected
    echo "<h1>Welcome to the tutor profile page!</h1>";
}


include("php/tutorsInfo.php");

?>





<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="header_folder/headerPartner.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/tutor_profile_page.css">
        
        <link rel="stylesheet" href="css/learnerRequest2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
        <link rel="stylesheet" href="css/tutorAvailableTimes.css">
        <!-- <link rel="stylesheet" href="css/calendar.css"> -->
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- //extras -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->


    </head>
    <body>
        <header>
            <div id="header-div">
                <nav class="fixed-top" id="main-nav">
                    <ul id="ul1">
                        <li><img src="images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                        <li class="list1-item"><a href="tutor_Home_page.php" class="list1-item">Home</a></li>
                        <li class="list1-item"><a href="php/SESSionTutor.php">Sessions</a></li>
                        <li class="list1-item"><a href="tutorReq.php">Requests</a></li>
                        <li class="list1-item"><a href="toturRate.php">Rates and Reviews</a></li>
                        <li class="list1-item"><a href="SupportsPartner.php">Support</a></li>
                    </ul>
                    <ul id="ul2">
                        
                        <li id="acnt li">
                            <nav id="account-nav"><img src="images/<?php echo  $image?>" id="account-img">
                                <ul>
                                    
                                    <li class="account-list"><a href="EditProfileP.php"><div class="circle"></div>Edit Profile</a></li>
                                    
                                    <li class="account-list"><a href="logout.php"><div class="circle"></div>Log Out</a></li>
                                </ul>
            
                            </nav>
                        </li>
                    </ul>
                </nav>
            </div>
            
        </header>
        <div class="main-body-conteniar">
            <div  class="main-body-content">
                <section class="pp-for-tutor">
                    
                        <img id = "image-of-tutor"src="images/<?php echo  $image?>" alt="Profile Picture">
                        <h2><?php echo $firstname.' '.  $lastname ?></h2>
                    
                </section>
                <section>
                    <h1>bio</h1>
                    <p id="bio"><?php echo $bio; ?></p>
                </section>
                <section class="Contact_tutor">
                    <h1>Contact</h1>
                    <div class= "Contact_tutor_div">
                            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?>
                            <span class="fas fa-envelope"></span>
                          </a>
                    </div>

                    <div class= "Contact_tutor_div">
                    <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?>
                            <span class="fas fa-phone-alt"></span>
                          </a>
                    </div>
<!-- 
                    <div class="email">
                      <span class="fas fa-envelope"></span>
                      <span class="text"><a href="mailto:content@linguist.com">content@linguist.com</a>
                        </span>
                     </div> -->
                </section>
        
                <section>
                    <h1>education</h1>
                    <?php echo $education?>
                </section>
                <section>
                    <h1>experiences</h1>
                    <?php echo $experience?>
                </section>
                <section>
                    <h1>Reviews</h1>

                </section>
                <h2>Book a Session</h2>
               <form method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
                <fieldset>
                    <div class="fieldset-container">
                    <div class="select-container">
                        <label>Language<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="Language">  
                                    <option></option>
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <option>Arabic</option>
                                </select>
                            </div>
                        </label>

                        <label name="level">Level<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="level">
                                    <option></option>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Advanced</option>
                                </select>
                            </div>
                        </label>

                        <label>Duration<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="Duration">
                                    <option></option>
                                    <option>10 Minutes</option>
                                    <option>20 Minutes</option>
                                    <option>30 Minutes</option>
                                    <option>60 Minutes</option>
                                </select>
                            </div>
                        </label>

                        <label>Date and Time<br>
                            <div class="selectWrapper" id="datetimepicker">
                                <input class="input-box" type="datetime-local">
                            </div>
                        </label>
                    </div>
                    <div class="btn-container">
                        <button class="selectWrapper" id="go-btn">Go!</button>
                    </div>
                </div>
                </fieldset>
            </form> 

            <label for="datepicker">Select Date:</label>
<input type="text" id="datepicker" name="datepicker">

<label for="available-times">Available Times:</label>
<select id="available-times" name="available-times"></select>









        </div>


  
  
        </div>
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
      

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery CDN -->
<script src="js/tutors.js"></script>



       
    </body>
</html>