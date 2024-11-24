<?php

// 1. Check the form is submitted via button click
if (isset($_POST['login-submit'])) {
  // 2. Connect to db
  require './connection.inc.php';

  // 3. Store form fields data in local variables
  echo $mailuid = $_POST['mailuid'];
  echo $password = $_POST['pwd'];

  // 4. Validate data by checking for empty fields (redirect on error)
  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?loginerror=emptyfields");
    exit();
  }

  // LOGIN PART 1: Check for matching user [PREPARED STATEMENT]
  // SQL Template
  $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";

  // Init SQL Statement + Prepare
  $statement = $conn->stmt_init();
  if (!$statement->prepare($sql)) {
    // ERROR: SQL Syntax error
    header("Location: ../index.php?error=sqlerror");
    exit();
  }

  // Bind the data to the statement
  $statement->bind_param("ss", $mailuid, $mailuid);

  // Execute the stmt & store the result
  $statement->execute();
  $result = $statement->get_result();

  if ($row = $result->fetch_assoc()) {
    // This compares password passed in by user VS encrypted password in DB
    $pwdCheck = password_verify($password, $row['pwdUsers']);

    // (i) ERROR: User exists BUT fails AUTH (Password is NOT a match using bcrypt)
    if (!$pwdCheck) {
      header("Location: ../index.php?loginerror=wrongpwd");
      exit();

      // (ii) AUTH SUCCESS: User exists + Password match (init session)
    } else {
      // NOTE: To save data which can be accessed on DIFFERENT pages and user stays logged in!
      session_start();
      // Adds data from $row['idUsers'] to session variable 
      $_SESSION['userId'] = $row['idUsers'];
      // Adds the data from $row['uidUsers'] to session variable
      $_SESSION['userUid'] = $row['uidUsers'];
      // REMINDER: idUsers = PRIMARY KEY / uidUsers = USERNAME
      header("Location: ../index.php?login=success");
      exit();
    }
    // (iv) ERROR: No user was found in DB
  } else {
    header("Location: ../index.php?loginerror=nouser");
    exit();
  }

  // 7. We have to close this off - it relates back to our SUBMIT button CHECK
} else {
  // ERROR: User has NOT submitted the form correctly
  header("Location: ../index.php?loginerror=forbidden");
  exit();
}


?>


