<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>




<main>
  <div class="container">
    <?php
    // 1. QUERY DATABASE for ALL POSTS
    // NOTE: No need for prepared statements - NOT posting data from users to DB.  Simply requesting data from DB to be displayed = NO SQL INJECTIONS POSSIBLE!

    // (i) Connect to Database
    require './includes/connection.inc.php';

    // (ii) Declare SQL command to DB to retrieve ALL rows from posts table in DB
    $sql = "SELECT id, title, imageurl ,comment, websiteurl FROM posts";

    // (iii) Call query & store result in variable
    $result = $conn->query($sql);
    ?>

    <?php
    // ERROR: ON DELETION OF POST 
    if (isset($_GET['error'])) {
      // (i) Internal server error 
      if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error has occurred - please try again later"; 
      }

      // (ii) Dynamic Error Alert based on Variable Value 
      echo '<div class="alert" role="alert">' . $errorMsg . '</div>';

      // SUCCESS: POST CREATE
    } else if (isset($_GET['post']) == "success") {
      echo '<div class="alert" role="alert">
          Post created! &#128054;
        </div>';

      // SUCCESS: POST EDIT 
    } else if (isset($_GET['edit']) == "success") {
      echo '<div class="alert" role="alert">
          Post edited! &#128054;
        </div>';

      // SUCCESS: POST DELETE
    } else if (isset($_GET['delete']) == "success") {
      echo '<div class="alert" role="alert">
          Post successfully deleted! &#128054;
        </div>';
    }
    ?>

    <?php
    // 2. CHECK FOR POSTS RETURNED RESULT & DISPLAY ON SUCCESS
    // (2.i) Success: Display Posts
    if ($result->num_rows > 0) {

      // 3. LOOP DATA INTO OUR BOOTSTRAP CARD TEMPLATE
      // (3.i) New variable with default state
      $output = "";

      // (3.ii) Take result -> convert to array & then insert into While Loop
      // NOTE: For EACH row in the array, we will execute this loop, so long as there are new rows - i.e. will execute for as many rows / positions in the array there are
      // NOTE: We make the output = our looping card HTML!
      while ($row = $result->fetch_assoc()) {


        // (3.iv) Join output cards together with .=
        // NOTE: We can test - as now we have multiple cards (just needs to be dynamic!)
        $output .=


      
          // (3.v) Dynamic Data into Cards using Concatenation of Variables
          // ORDER (from easiest): title, comment, id, image, alt (with title), websiteurl, websitetitle
          '<div class="card border " id="' . $row['id'] . '">
              <img src="' . $row['imageurl'] . '" class="cardimg post-image" alt="' . $row['title'] . '">
              <div class="card-body">
                <h5 class="card-title">' . $row['title'] . '</h5>
                <p class="card-text">' . $row['comment'] . '</p>
                <a href="' . $row['websiteurl'] . '" class="btn" target="_blank">' . '</a>';


        if (isset($_SESSION['userId'])) {
          $output .= '
                  <div class="admin-btn">
                    <a href="editpost.php?id=' . $row['id'] . '" class="btnloginpg">Edit</a>
                    <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btnloginpg ">Delete</a>
                  </div>';
        }

        $output .=
          '
              </div>
            </div>
            ';
      }





      // (3.iii) Echo out the result of the loop
      echo $output;
      // NOTE: PROBLEM - Every time loop runs, we essentially assign HTML to output.  This means, everytime we loop, we keep replacing output over and over with the latest card. 
      // FIXED: We can tell php to JOIN each card onto each other above in (iv) using ".="


      // (2.ii) Error: Template Error Message
      // NOTE: You can probably render a better error message
    } else {
      echo "0 results";
    }
    // (2.iii) Close Connection
    $conn->close();
    ?>

    <!-- <section class="grid-container">




    <main class="container p-4 bg-light mt-3">
      editpost.inc.php - Will process the data from this form-->


  </div>
</main>



<?php include './templates/footer.php' ?>