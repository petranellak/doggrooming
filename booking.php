<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookings</title>
</head>

<body>

  <div class="container">
    <h2 class="heading">Book a Grooming!</h2>
    <p class="quicksandregular">Grooming for cats coming soon!</p>


    <section>
      <div class="form-wrap tx-flex formgroom">
        <form action="./includes/booking.inc.php" method="POST">

          <?php
          // 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
          if (isset($_GET['error'])) {
            // (i) Empty fields validation 
            if ($_GET['error'] == "emptyfields") {
              $errorMsg = "Please fill in all fields &#128534";

              // (ii) Forbidden request
            } else if ($_GET['error'] == "forbidden") {
              $errorMsg = "Please submit the form correctly &#128534";

              // (iii) 500 Internal server error (sql or server)
            } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
              $errorMsg = "An internal server error has occurred - please try again later &#128534";
            }

            // (iv) ERROR CATCH-ALL:
            echo '<div class="alert" role="alert">' . $errorMsg . '</div>';

            // (iv). SUCCESS MESSAGE: Post saved successfully to DB -> NOT on this page.  We redirect them to posts.php, so we will need to add it there LATER!
          }
          ?>




          <div class="form-group">
            <!-- <label for="first-name">First Name</label> -->
            <input type="text" placeholder="First Name" name="firstName" id="first-name">
          </div>


          <div class="form-group">
            <!-- <label for="last-name">Last Name</label> -->
            <input type="text" placeholder="Last Name" name="lastName" id="last-name">
          </div>


          <div class="form-group">
            <!-- <label for="dog-name">Dog Name</label> -->
            <input type="text" placeholder="Dog Name" name="dogName" id="dog-name">
          </div>

          <div class="form-group">
            <!-- <label for="email">Email</label> -->
            <input type="email" placeholder="Email" name="email" id="email">
          </div>

          <div class="form-group">
            <!-- <label for="mobile">Mobile</label> -->
            <input type="text" placeholder="mobile" name="mobile" id="mobile">
          </div>

          <div>
            <label>Groom Date: </label>
            <input type="date" name="groomDate">
          </div>

          <div class="select">

            <label for="drop-off">Drop Off</label>
            <select name="dropOff" id="drop-off">
              <option value="07:00:00">Early Bird 7:00am</option>
              <option value="10:00:00">After Coffee 10:00am</option>
              <option value="14:00:00">After Soapies 2:00pm</option>

            </select>
          </div>

          <div class="select ">

            <label for="clip-style">Clip Style</label>
            <select name="clipStyle" id="drop-off">
              <option value="maintenance">Maintenance Clip</option>
              <option value="dayout">Park Ready Clip</option>
              <option value="brushout">Full Brush Out Clip</option>
              <option value="long">I have long hair</option>

            </select>
          </div>

          <div>
            <input type="submit" name="booking-submit" value="submit">
          </div>
        </form>

        <div class="echoout whitedog">


          <div> <img src="./images/whitedogsml.webp" alt="laughing white dog">



          </div>

        </div>


      </div>
  </div>
  </section>



  <section id="location">
    <div class="doggroompic tx-flex">

      <div>
        <img class="wavy-box" src="./images/doggroomingpic.webp" alt="small dog gets clip">
      </div>

      <div id="contactdetails" class="wrapper">

        <ul class="openinghours quicksandregular">

          <li class="quicksandregular"> Find us here</li>
          <li>10 Clipper Place </li>
          <li>MOORABBIN VIC 3001</li>
          <br>

          <li class="quicksandregular">Contact</li>
          <li>0400 000 001</li>
          <li class="quicksandregular">hello@dog&i.com.au</li>
          <br>

          <li class="quicksandregular">Opening Hours</li>
          <li>Mon - closed</li>
          <li>Tues-Sat 7:00am - 6:00pm</li>
          <li>Sun - closed</li>

        </ul>

      </div>


    </div>
  </section>





  <?php include './templates/footer.php' ?>