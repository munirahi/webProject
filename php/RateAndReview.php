<?php
session_start(); 
// Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}



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
  <link rel="stylesheet" href="../css/RateAndReview.css" />
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
          <li class="list1-item"><a href="../HomePageLearner.php" class="list1-item">Home</a></li>
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
 
      <br><br><br>
         <h2>Rates and Reviews</h2>
    </div>

    <section class="week-sesstoin">
      <br><br><br>
      <div class="request-card">
       <br><br><br>
       <form action ="SESSionLearner.php" method="post" >
      <div class="item">

                <div class="rating">
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                </div>
                  <form action="save_feedback.php" method="POST">
                    <input  name="ReviewText" cols="21" placeholder="Describe your experience.. value="'.$row['ReviewText'].'">
                    <input type="hidden" name="rating" .'$row['starts'].' id="rating-value" value="0">
                    <button class="post-btn" type="submit">Post</button>
                    <br><br><br><br>
                  </form>
                </div>
              </div>
              </section>
               </div>
              </section>
             
<script>
  const ratingContainers = document.getElementsByClassName("rating");

  function executeRatings(containers) {
    const starClassActive = "rating__star fas fa-star";
    const starClassInactive = "rating__star far fa-star";

    Array.from(containers).forEach((container) => {
      const stars = container.getElementsByClassName("rating__star");

      Array.from(stars).forEach((star) => {
        star.onclick = () => {
          const clickedIndex = Array.from(stars).indexOf(star);

          for (let i = 0; i < stars.length; i++) {
            if (i <= clickedIndex) {
              stars[i].className = starClassActive;
            } else {
              stars[i].className = starClassInactive;
            }
          }
        };
      });
    });
  }

  executeRatings(ratingContainers);
</script>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      if(isset($_GET["ReviewText"]) && isset($_GET["starts"])  ) {
        
          $ReviewText = $_GET["ReviewText"];
          $starts = $_GET["starts"];

          // Prepare and execute the SQL update query
          $sql = "UPDATE review SET starts='$starts', ReviewText='$ReviewText' WHERE L_ID='$L_id';";
          if (mysqli_query($conn, $sql)) {
              echo "rate updated successfully";
          } else {
              echo "Error updating rate: " . mysqli_error($conn);
          }
      } else {
          echo "";
      }
  } else echo '';
?>   
</body>
</html>
