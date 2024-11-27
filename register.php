<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>

<div class="container">
  <form action="./includes/register.inc.php" method="post">

    <h2 class="heading">Register</h2>

    <p class="paragraph">Register to be able to post and upload images</p>

    <?php
    // 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
    if (isset($_GET['error'])) {

      // (i) Empty fields validation 
      if ($_GET['error'] == "emptyfields") {
        $errorMsg = "Please fill in all fields &#128520;";

        // (ii) Invalid Email AND Password
      } else if ($_GET['error'] == "invalidmailuid") {
        $errorMsg = "Invalid email and Password &#128556;";

        // (iii) Invalid Email
      } else if ($_GET['error'] == "invalidmail") {
        $errorMsg = "Invalid email &#128556;";

        // (iv) Invalid Username
      } else if ($_GET['error'] == "invaliduid") {
        $errorMsg = "Invalid username &#128556;";

        // (v) Password Confirmation Error
      } else if ($_GET['error'] == "passwordcheck") {
        $errorMsg = "Passwords do not match &#128556;";

        // (vi) Username MATCH in database on save
      } else if ($_GET['error'] == "usertaken") {
        $errorMsg = "Username already taken &#128556;";

      } else if ($_GET['error'] == "invalidpwd") {
        $errorMsg = "Invalid password - you need to create a password with at least 1 capital letter, 1 number & 1 special character";

        // (vii) Internal server error 
      } else if ($_GET['error'] == "sqlerror") {
        $errorMsg = "An internal server error has occurred - please try again later &#128556;";

        // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
      }
      echo '<div class="alert" role="alert">' . $errorMsg . '</div>';

      // 2. SUCCESS MESSAGE: Successful sign up to DB
    } else if (isset($_GET['signup']) == "success") {
      echo '<div class="alert" role="alert">You have successfully signed up!&#128525;</div>';
    }
    ?>



    <!-- 1. USERNAME -->

    <!-- (i) If an invalid email - echo back the correct username (uid) -->

    <div class="emaillogin">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="uid" placeholder="Username" value=<?php if (isset($_GET['uid'])) {
                                                                                        echo ($_GET['uid']);
                                                                                      } ?>>
    </div>

    <!-- 2. EMAIL -->
    <!-- (ii) If an invalid username - echo back the correct email (mail) -->

    <div class="emaillogin">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" name="mail" placeholder="Email Address" value=<?php if (isset($_GET['mail'])) {
                                                                                              echo $_GET['mail'];
                                                                                            } ?>>
    </div>

      <!-- 3. PASSWORD -->

      <div class="passwordlogin">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="pwd" placeholder="Password">
      </div>
      <p class="paragraph">Your password must include eight charectars including a capital, number and special charectar</p>

      <!-- 4. PASSWORD CONFIRMATION -->

      <div class="passwordlogin">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
      </div>

      <button type="submit" name="signup-submit" class="btnloginpg ">Register</button>

  </form>

  <!-- 5. SUBMIT BUTTON -->


</div>

</main>

<?php include './templates/footer.php' ?>