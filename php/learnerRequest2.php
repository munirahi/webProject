<?php
    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','linguist');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME)) 
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");
   
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Request</title>
        <link rel="stylesheet" href="../css/learnerRequest2.css">
        <link rel="stylesheet" href="../css/tutorReq.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../header_folder/headerLearner.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/59189109f7.js" crossorigin="anonymous"></script>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>


        <header id="header">
            <div id="header-div">
            <nav class="fixed-top" id="main-nav">
                <ul id="ul1">
                    <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img" ></li>
                    <li class="list1-item"><a href="HomePageLearner.html" class="list1-item">Home</a></li>
                    <li class="list1-item"><a href="SESSionLearner.html">Sessions</a></li>
                    <li class="list1-item" ><a href="learnerRequest2.html">Requests</a></li>
                    <li class="list1-item"><a href="RateAndReview.html">Rate and Review</a></li>
                    <li class="list1-item"><a href="Supports.html">Support</a></li>
                </ul>
                <ul id="ul2">

                    <li id="acnt li">
                        <nav id="account-nav"><img src="../images/account.jfif" id="account-img">
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
         

         <main class="grid-container">

        <div class="containing-div">

            <div class="request_div inner-div">
                <h5 id="new-req-header">Create a New Request!</h5>
                <form method="get">
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
    
                            <!-- <label name="level">Level<br>
                                <div class="selectWrapper">
                                    <select class="input-box" name="Level">
                                        <option></option>
                                        <option>Beginner</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                    </select>
                                </div>
                            </label> -->

                            <!-- <label name="date">Date<br>
                                <div class="selectWrapper">
                                    <select class="input-box" name="dateSelect">

                                    </select>
                                </div>
                            </label> -->
    
                            <!-- <label>Duration<br>
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
                                <div class="selectWrapper">
                                    <input class="input-box" type="datetime-local">
                                </div>
                            </label> -->
                        </div>
                        <div class="btn-container">
                            <button class="selectWrapper" id="go-btn">Go!</button>
                        </div>
                    </div>
                    </fieldset>
                </form>


                <?php
// Include your database connection code here

//if(isset($_GET['language']) && isset($_GET['level'])) {
    // $language = $_GET['Language'];
    // $level = $_GET['Level'];

    // // Fetch dates from the database based on the selected language and level
    // $sql3 = "SELECT DISTINCT date FROM available_times, tutor_languages WHERE Language = '$language' AND Level = '$level' AND tutor_languages.P_ID = available_times.P_ID";
    // $result3 = mysqli_query($conn, $sql3);

   
    // if(mysqli_num_rows($result3) > 0) {
    //     echo "<script>";
    //     echo "var select = document.getElementById('dateSelect');";
    //     while($row3 = mysqli_fetch_assoc($result3)) {
    //         echo "var option = document.createElement('option');";
    //         echo "option.text = '{$row3['date']}';";
    //         echo "select.add(option);";
    //     }
    //     echo "</script>";
    // } else {
    //     echo "<script>";
    //     echo "var select = document.getElementById('dateSelect');";
    //     echo "select.innerHTML = '<option>No dates available</option>';";
    //     echo "</script>";
    // }
// else echo"help";
?>

               



                 <h5 id="result-header">Results</h5>
                <div class="result">
                <div class="result-carousel">  
                    <!--div class="result-carousel"-->

                    <?php
 if(isset($_GET['Language'])  ) { //&& isset($_GET['Duration'])
    $sql = "SELECT * FROM tutor, tutor_languages where Language='" .$_GET['Language']."' AND P_ID=ID "; //AND Duration='" .$_GET['Duration']. "' "
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { // $result=="false"
        while($row = mysqli_fetch_assoc($result)) {
                   // echo '<tr> <td>'.$row['name'].'</td> <td>'.$row['license'].'</td> <td>'.$row['owner'].'</td> </tr>'; 
              //echo 'hi';
                    echo   

                    '
                    <div class="result-cell"> 
                    <div class="acc-info">  
                    <img class="result-img" src="../images/'.$row['image'].'" alt="account image">
                     <div class="more-info"><h6>
                    <i class="fa-solid fa-user"></i> '.$row['Firstname']. " "  .$row['Lastname'].' <i class="fa-solid fa-star"></i> 4 <i class="fa-solid fa-dollar-sign"></i> 45</h6>
                    <h6 id="categories">'.$row['Language'].' </h6> </div> </div> 
                    <div class="bio"><p>'./*.$row['bio'].*/'</p></div> 
                    <form action="tutor_profile_page.php" method="post">
    <input type="hidden" name="tutor_id" value="'.$row['ID'].'">
    <div type="submit" class="post-req-btn"><button>View Profile</button></div></div> 
</form>';
                  
                    }}//end while
                    else
                    echo '<h3>No results.</h3>';
             }
            
    ?>

</div> 
               
                </div>
                
            </div>

            <div class="status-div inner-div">
                <h5>Requests Status</h5>
                <div class="inner-status">
                   
        <?php

$sql2 = "SELECT * FROM request,tutor where L_ID='" .$_SESSION['user_id']. "' AND P_ID = tutor.ID" ; 
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) { // $result=="false"
    while($row2 = mysqli_fetch_assoc($result2)) {

        if( strcasecmp($row2["Status"], "accepted") == 0 ||  strcasecmp($row2["Status"], "rejected") == 0){
   
               echo     '<div class="status-cell">
                        <div class="acc-info">
                            <img src="../images/'.$row2['image'].'" alt="account image">
                            <div class="status-info">
                               <h6><i class="fa-solid fa-user"></i> '.$row2['Firstname']. " "  .$row2['Lastname'].'</h6>
                              
                            </div>
                           </div>
                           <div class="specifications-div">
                           <div class="language specifications">'.$row2['Language'].'</div>
                           <div class="level specifications">'.$row2['Level'].'</div>
                           <div class="duration specifications">'.$row2['Duration'].' Minutes</div>
                           <div class="time specifications">'.date("h:i A", strtotime($row2['Time'])).'</div>
                           <div class="date specifications">'.$row2['Date'].'</div>
                       </div>
                                           <h6 class="status" id="'.$row2['Status'].'">'.$row2['Status'].'</h6>
                                           <button class="edit" id="disabled">Edit</button>
                                            <button class="cancel" id="disabled">Cancel</button>
                    </div>';

    } elseif( strcasecmp($row2["Status"], "pending") == 0){
        $status = $row2["Status"];
        echo     '<div class="status-cell">
        <div class="acc-info">
            <img src="../images/'.$row2['image'].'" alt="account image">
            <div class="status-info">
               <h6><i class="fa-solid fa-user"></i> '.$row2['Firstname']. " "  .$row2['Lastname'].'</h6>
              
            </div>
           </div>

           <div class="specifications-div">
           <div class="language specifications">'.$row2['Language'].'</div>
           <div class="level specifications">'.$row2['Level'].'</div>
           <div class="duration specifications">'.$row2['Duration'].' Minutes</div>
           <div class="time specifications">'.date("h:i A", strtotime($row2['Time'])).'</div>
           <div class="date specifications">'.$row2['Date'].'</div>
       </div>
           <h6 class="status" id="pending">'.$row2['Status'].'</h6>
           <form action="EditRequest.php" method="post">
<input type="hidden" name="p_id" value="'.$row2['P_ID'].'">
<input type="hidden" name="l_id" value="'.$_SESSION['user_id'].'">
<input type="hidden" name="time" value="'.$row2['Time'].'">
<input type="hidden" name="date" value="'.$row2['Date'].'">
<button class="edit" type="submit">Edit</button>
</form>
           
            <button class="cancel" >Cancel</button>
    </div>';
    echo $row2['P_ID'].'<br>';
    echo $_SESSION['user_id'];
    }


}}else echo 'no result';


                ?>

                   




                </div>
                
            </div>
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

