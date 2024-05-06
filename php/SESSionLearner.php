<!DOCTYPE html>
<html>
  <!--upcoming and current sessions learner-->
  <head>
    <script>
        function cancelSession(sessionId) {
    if (confirm("Are you sure you want to cancel this session?")) {
        fetch('cancel_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'sessionID=' + sessionId
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error canceling the session.');
        });
    }
}
//delete fun
function deleteSession(sessionId) {
    if (confirm("Are you sure you want to delete this session permanently?")) {
        fetch('delete_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'sessionID=' + sessionId
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error deleting the session.');
        });
    }
}


    </script>
    <meta charset="utf-8" />
    <title>Learner sesstions</title>
    <link rel="stylesheet" type="text/css" href="../css/SessionLearner.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/sidebar-tutor.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="../header_folder/headerPartner.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/footer.css" />
    <!-- icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <script
    src="https://kit.fontawesome.com/5a18e3112f.js"
    crossorigin="anonymous"></script>
  <body>
    <header id="header">
      <div id="header-div">
        <nav class="fixed-top" id="main-nav">
          <ul id="ul1">
            <li>
              <img
                src="../images/linguistBlueAndWhite.jpg"
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
              <a href="toturRate.html">Rate and Review</a>
            </li>
            <li class="list1-item">
              <a href="SupportsPartner.html">Support</a>
            </li>
          </ul>
          <ul id="ul2">
            <li id="acnt li">
              <nav id="account-nav">
                <img src="../images/account.jfif" id="account-img" />
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
<?php
include 'connection.php'; // Make sure your database connection settings are correct

// Current Sessions: Active sessions with today's date and time
$sql_current = "
    SELECT s.*, t.FirstName, t.LastName
    FROM session s
    JOIN tutor t ON s.T_id = t.ID
    WHERE s.Date = CURDATE()
      AND TIME(DATE_ADD(CONCAT(s.Date, ' ', s.Time), INTERVAL s.Duration MINUTE)) >= CURTIME()
      AND s.Time <= CURTIME()
";
$current_sessions = mysqli_query($conn, $sql_current);

// Upcoming Sessions: Future sessions starting after now
$sql_upcoming = "
    SELECT s.*, t.FirstName, t.LastName
    FROM session s
    JOIN tutor t ON s.T_id = t.ID
    WHERE s.Date > CURDATE()
      OR (s.Date = CURDATE() AND s.Time > CURTIME())
";
$upcoming_sessions = mysqli_query($conn, $sql_upcoming);

// Previous Sessions: Sessions that have ended
$sql_previous = "
    SELECT s.*, t.FirstName, t.LastName
    FROM session s
    JOIN tutor t ON s.T_id = t.ID
    WHERE s.Date < CURDATE()
      OR (s.Date = CURDATE() AND TIME(DATE_ADD(CONCAT(s.Date, ' ', s.Time), INTERVAL s.Duration MINUTE)) < CURTIME())
";
$previous_sessions = mysqli_query($conn, $sql_previous);



?>

    <section class="center">
      <section class="current-sessions-container">
        <section class="current-sessions">
          <h3 id="current-session-title">Current Session</h3>
          <section class="Today-sessions">
<!-- Current Sessions Section -->
<div class="current-sessions-card">
    <?php while ($row = mysqli_fetch_assoc($current_sessions)) { ?>
        <div class="carousel-cell">
            <img class="current-session-img" src="../images/maleIcon3.png" alt="current-session"/>
            <div class="card-inner">
                <h5><strong><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></strong></h5>
                <section class="incard-elements-sessions">
                    <p class="language"><?php echo $row['language']; ?></p>
                    
                    <p class="duration"><?php echo $row['Duration']; ?> Minutes</p>
                </section>
                <a class="enter-btn-current" href="#">Join</a>
            </div>
        </div>
    <?php } ?>
</div>
</section>
        </section>
      </section>

      <section class="session-Bigcontainer">
        <section class="new-requests-container">
          <h3>Upcoming Sessions</h3>
          <br />
          <section class="requests">
            <section class="container px-2">
<!-- Upcoming Sessions Table -->
<div class="table-responsive">
    <table class="table table-responsive table-borderless">
        <tbody>
        <thead>
                    <tr class="bg-light">
                      <th scope="col" width="5%">#</th>
                      <th scope="col" width="20%">Date</th>
                      <th scope="col" width="10%">Duration</th>
                      <th scope="col" width="20%">Tutor name</th>
                      <th scope="col" width="20%">language</th>
                      <th scope="col" width="20%">
                        <span>Time</span>
                      </th>
                    </tr>
                  </thead>
            <?php while ($row = mysqli_fetch_assoc($upcoming_sessions)) { ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo date('j M, Y', strtotime($row['Date'])); ?></td>
                    <td><span class="ms-1"><?php echo $row['Duration']; ?> Minutes</span></td>
                    <td>
                        <img src="../images/maleIcon3.png" width="25" alt="Tutor"/>
                        <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>
                    </td>
                    <td><img src="../images/united-states.png" width="20" alt="Language"/><?php echo $row['language']; ?></td>
                    <td class="text-end">
                        <span class="fw-bolder"><?php echo date('g:iA', strtotime($row['Time'])); ?></span>
                        <button class="cancel-btn" onclick="cancelSession(<?php echo $row['ID']; ?>);">Cancel</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</section>
 </section>
 </section>
 

 <section class="new2-requests-container">
          <h3>Previous Sessions</h3>
          <br />
          <section class="requests">
            <section class="container px-2">
<!-- Previous Sessions Table -->
<div class="table-responsive">
    <table class="table table-responsive table-borderless">
        <tbody>
        <thead>
                    <tr class="bg-light">
                      <th scope="col" width="5%">#</th>
                      <th scope="col" width="20%">Date</th>
                      <th scope="col" width="10%">Duration</th>
                      <th scope="col" width="20%">Tutor name</th>
                      <th scope="col" width="20%">language</th>
                      <th scope="col" width="20%">
                        <span>Time</span>
                      </th>
                    </tr>
                  </thead>
            <?php while ($row = mysqli_fetch_assoc($previous_sessions)) { ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo date('j M, Y', strtotime($row['Date'])); ?></td>
                    <td><span class="ms-1"><?php echo $row['Duration']; ?> Minutes</span></td>
                    <td>
                        <img src="../images/maleIcon3.png" width="25" alt="Tutor"/>
                        <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?>
                    </td>
                    <td><img src="../images/united-states.png" width="20" alt="Language"/><?php echo $row['language']; ?></td>
                    <td class="text-end">
                        <span class="fw-bolder"><?php echo date('g:iA', strtotime($row['Time'])); ?></span>
                        <button class="cancel-btn" onclick="deleteSession(<?php echo $row['ID']; ?>);">Delete</button>
                    </td>
                </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>
</section>
          </section>
          <div class="day">
            <a href="RateAndReview.html"><button class="rate-btn-current">Rate and Review!</button></a>
          </div>
          <!-- end of requests -->
        </section>
      </section>
      </section>

    <!--Footer-->

    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>
              Embark on a linguistic journey with LINGUIST. Connect with native
              speakers worldwide, hone your language skills through immersive
              experiences, and unlock new cultures from the comfort of your
              home.
              <a class="find-more" href="About_us_pageMain.html">Find more</a>
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
                ><a href="mailto:content@linguist.com"></a>
                content@linguist.com</span
              >
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
                <button type="submit" style="width: 51.71px">Send</button>
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