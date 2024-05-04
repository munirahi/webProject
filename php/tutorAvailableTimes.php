<?php
    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost:4306');
    DEFINE('DB_NAME','linguist');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD))
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");

  session_start();
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Times</title>
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="header_folder/headerLearner.css">
        <link rel="stylesheet" href="css/tutorAvailableTimes.css">
        <!-- <link rel="stylesheet" href="css/calendar.css"> -->
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>

        <!-- <header id="header"> -->
            <div id="header div">
            <nav class="fixed-top" id="main-nav">
                <ul id="ul1">
                  <li id="disabled"><img src="images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img" ></li>
                  <li class="list1-item"><a href="HomePageLearner.html" class="list1-item">Home</a></li>
                  <li class="list1-item"><a href="SESSionLearner.html">Sessions</a></li>
                  <li class="list1-item"><a href="learnerRequest2.html">Requests</a></li>
                  <li class="list1-item"><a href="RateAndReview.html">Rate and Review</a></li>
                  <li class="list1-item"><a href="Supports.html">Support</a></li>
                </ul>
                <ul id="ul2">
                    <li id="acnt li">
                        <nav id="account-nav"><img src="images/account.jfif" id="account-img">
                            <ul>
                                
                                <li class="account-list"><a href="#"><div class="circle"></div>Edit Account</a></li>
                                
                                <li class="account-list"><a href="#"><div class="circle"></div>Log Out</a></li>
                            </ul>

                        </nav>
                    </li>
                </ul>
            </nav>
        </div>
         <!-- </header> -->

         <main>
        <div class="containing-div">
            <div class="request_div">
                <h3 id="edit-req-header">Edit Your Available Times</h3>

                <section id="section-month" class="month main">
                    <header id="header">
                        <h1 id="current-month-year"></h1>
                    </header>

                    <article id="article">
                        <div class="days">
                            <b>S</b>
                            <b>M</b>
                            <b>T</b>
                            <b>W</b>
                            <b>T</b>
                            <b>F</b>
                            <b>S</b>
                        </div>
                        <div id="dates" class="dates">
                            <!-- Dates will be generated dynamically here -->
                        </div>
                    </article>
                </section>

                <section id="appointment-hours-container">
                    <h4 id="appointments-title">Appointments</h4>
                    <div id="appointment-hours" class="appointment-hours"></div>
                    <div class="btn-container">
                                <button class="selectWrapper" id="save-btn">Save Changes</button>
                                <button class="selectWrapper" id="discard-btn">Discard Changes</button>
                            </div>
                </section>
            </div>
        </div>
    </main>
    <!-- src="js/calendarForTutor.js" -->
    <script >
      let selectedDate = null; // Track the currently selected date
    let selectedTimes = {}; // Track the selected times for each date

    document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date();
    const currentDay = currentDate.getDate();
    
    const currentMonth = currentDate.getMonth();
    const currentYear = currentDate.getFullYear();
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    document.getElementById("current-month-year").textContent = monthNames[currentMonth] + " " + currentYear;


    const datesContainer = document.getElementById("dates");
    const appointmentHoursContainer = document.getElementById("appointment-hours");

    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();

    for (let i = 0; i < firstDayIndex; i++) {
        const emptyDateElement = document.createElement("span");
        emptyDateElement.classList.add("disable");
        datesContainer.appendChild(emptyDateElement);
    }

    for (let i = 1; i <= daysInMonth; i++) {
        const dateElement = document.createElement("span");
        dateElement.textContent = i;
        dateElement.classList.add("date");
        // Add click event listener to dates
        dateElement.addEventListener("click", function () {
            // Toggle selected class on the date element
            if (selectedDate !== this) {
                if (selectedDate !== null) {
                    const selectedTimesForPrevDay = selectedTimes[selectedDate.textContent] || [];
                    if (selectedTimesForPrevDay.length === 0) {
                        selectedDate.classList.remove("selected");
                    }
                }
                this.classList.add("selected");
                selectedDate = this;

                // Generate appointment hours for the selected date
                generateAppointmentHours(i);
            }
        });
        datesContainer.appendChild(dateElement);
    }

    // Generate appointment hours
    function generateAppointmentHours(day) {
        // Retrieve the previously selected times for the current date (if any)
        const selectedTimesForDay = selectedTimes[day] || [];

        appointmentHoursContainer.innerHTML = ""; // Clear existing content

        for (let hour = 8; hour <= 19; hour++) {
            const appointmentHour = document.createElement("span");
            appointmentHour.textContent = `${hour}:00 - ${hour + 1}:00`;
            appointmentHour.classList.add("appointment-hour");

            // Check if this hour is already selected for the current date
            if (selectedTimesForDay.includes(hour)) {
                appointmentHour.classList.add("selected");
            }

            // Add click event listener to toggle selection
            appointmentHour.addEventListener("click", function () {
                // Toggle selected class on the appointment hour element
                this.classList.toggle("selected");

                // Update selectedTimes object based on the current selection
                if (!selectedTimes[day]) {
                    selectedTimes[day] = [];
                }
                const index = selectedTimes[day].indexOf(hour);
                if (index === -1) {
                    selectedTimes[day].push(hour);
                } else {
                    selectedTimes[day].splice(index, 1);
                }

                // Highlight the date if at least one time is selected
                const dateElement = selectedDate;
                if (Object.keys(selectedTimes[day]).length > 0) {
                    dateElement.classList.add("selected");
                } else {
                    dateElement.classList.remove("selected");
                }
            });

            // Append the appointment hour to the container
            appointmentHoursContainer.appendChild(appointmentHour);
        }
    }
});


 // Handle form submission
document.getElementById("save-btn").addEventListener("click", function () {
    // Convert selectedTimes array to JSON string
    const jsonData = JSON.stringify(selectedTimes);

    // Log the jsonData variable to the console
    console.log(jsonData);

    // Create a form element
    const form = document.createElement("form");
    form.method = "post";
    form.action = "";

    // Create a hidden input field to store JSON data
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "jsondata";
    input.value = jsonData;

    // Append the input field to the form
    form.appendChild(input);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
});

</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the JSON data is sent
  if (isset($_POST['jsondata'])) {
      // Decode the JSON data into a PHP array
      $selectedTimes = json_decode($_POST['jsondata']);

      // Check if decoding was successful
      if ($selectedTimes !== null) {
          // Access the selected appointment times
          foreach ($selectedTimes as $date => $times) {
              foreach ($times as $time) {
                  // Insert each appointment time into the database
                  $ID = $_SESSION['user_id'];
                  $sql = "INSERT INTO available_times (P_ID, Time, Date, availability) VALUES ('$ID','$time', '$date', 'true')";
                  $result = mysqli_query($conn, $sql);
                  if ($result === TRUE) {
                      echo "<div>Appointment time '$time' for date '$date' inserted successfully.</div>";
                  } else {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                  }
              }
          }
      } else {
          echo "Error decoding JSON data.";
      }
  } else {
      echo "No JSON data received.";
  }
}else echo 'hiiiiiiiiiiiiii1';

// Close the database connection
$conn->close();
?>

         <footer>
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
      </footer>

    </body>
</html>
