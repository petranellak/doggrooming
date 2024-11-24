<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>


<?php


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "DogGrooming";

// create connection with database - do database in msql

$conn = mysqli_connect($servername, $username, $password, $dbname);

// test connection

// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo  "Connection working!";



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