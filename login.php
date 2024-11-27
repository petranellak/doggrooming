<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>




<?php

require './includes/connection.inc.php';

// 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
if (isset($_GET['error'])) {

  // (i) Empty fields validation 
  if ($_GET['error'] == "emptyfields") {
    $errorMsg = "Please fill in all fields &#128520;";


    // (ii) 500 ERROR: SQL Error
  } else if ($_GET['error'] == "sqlerror") {
    $errorMsg = "Internal server error - please try again later";

    // (iii) uidUsers / emailUsers do not match
  } else if ($_GET['error'] == "nouser") {
    $errorMsg = " The user does not exist";
    // $errorMsg = "Incorrect credentials";

    // (iv) Password does NOT match DB 
  } else if ($_GET['error'] == "wrongpwd") {
    $errorMsg = " Wrong password";
    // $errorMsg = "Incorrect credentials";

    // (iii) loginerror=forbidden
  } else if ($_GET['error'] == "forbidden") {
    $errorMsg = "Please submit form correctly";
  }
  // ERROR CATCH-ALL: Display alert with dynamic error message
  echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
} else if (isset($_GET['login']) == "success") {
  // SUCCESS: User login successful message
  echo '<div class="alert alert-primary" role="alert">Welcome ' . $_SESSION['userUid'] . '</div>';
}
?>

<div class="container">
  <form action="./includes/login.inc.php" method="post">

    <h2 class="heading">Login</h2>
    <p class="paragraph">Login to access posting and comment features</p>

    <!-- Username -->
    <div class="emaillogin">
      <label for="email" class="form-label">Email</label>
      <input type="text" id="email" class="form-control" name="mailuid" placeholder="email">
    </div>

    <!-- Password -->
    <div class="passwordlogin">
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" class="form-control" name="pwd" placeholder="Password">
    </div>


    <!-- Submit Button -->
    <div>
      <button type="submit" name="login-submit" class="btnloginpg ">Login</button>

    </div>
  </form>

</div>

<?php include './templates/footer.php' ?>