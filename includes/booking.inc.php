<?php
session_start();
if (isset($_POST['booking-submit']) && isset($_SESSION['userId'])) {
  // Connection
  require './connection.inc.php';

  // Store form data in local var
  $fName = $_POST['firstName'];
  $lName = $_POST['lastName'];
  $dogName = $_POST['dogName'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $groomDate = $_POST['groomDate'];
  $dropOff = $_POST['dropOff'];
  $clipStyle = $_POST['clipStyle'];

  // 1. VALIDATION: Check for empty fields
  if (empty($fName) || empty($lName) || empty($dogName) || empty($email) || empty($mobile) || empty($groomDate) || empty($dropOff) || empty($clipStyle)) {

    header("Location: ../booking.php?error=emptyfields");
    exit();
  }

  // 2. PREPARED STATEMENTS: Insert posts data into posts table
  // [a] Templating
  $sql = "INSERT INTO bookGroom(id,fName,lName,dogName,email,mobile,groomDate,dropOff,clipStyle) VALUES (NULL,?,?,?,?,?,?,?,?)";
  $statement = $conn->stmt_init();
  if (!$statement->prepare($sql)) {
    // ERROR: The template SQL has an error
    header("Location: ../booking.php?error=sqlerror");
    exit();
  }

  // [b] Execution
  $statement->bind_param("ssssssss", $fName, $lName, $dogName, $email, $mobile, $groomDate, $dropOff, $clipStyle);
  $statement->execute();

  // 3. REDIRECT USER ON SUCCESS: Go to posts.php page
  if ($statement->error) {
    // header("Location: ../booking.php?error=servererror");
    echo $statement->error;
    exit();
  }

  // Success Post
  header("Location: ../booking.php?post=success");
  exit();
} else {
  header("Location: ../booking.php?error=forbidden");
  exit();
}
