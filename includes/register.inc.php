
<?php
if (isset($_POST['signup-submit'])) {
  // Connect to DB
  require './connection.inc.php';

  // Store form data
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  // check for empty fields


  // password combinations - num, capital

  $pwdReg = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";



  // Validation
  // a. Check for empty fields
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    // ERROR: Redirect the user BACK to signup.php
    header("Location: ../register.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
    exit();

    // DOUBLE CHECK: Username AND email are BOTH incorrect
  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmailuid");
    exit();

    // b. Check the username for length & characters
  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../register.php?error=invaliduid&mail=" . $email);
    exit();

    // c. Check for email construction (e.g. @something.com)
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmail&uid=" . $username);
    exit();

    // / d. Password strength (length, special characters, combinations)
  } else if (!preg_match($pwdReg, $password)) {
    header("Location: ../register.php?error=invalidpwd&uid=" . $username . "&mail=" . $email);
    exit();

    // e. Check the password = password confirm
  } else if ($password !== $passwordRepeat) {
    header("Location: ../register.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
    exit();


    // REGISTRATION OPERATIONS [Prepared Statements]
  } else {
    // A. Check there is no DUPLICATE user existing (= user is unique!)
    // (i) Declare the "template" SQL
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";

    // (ii) Init SQL statement
    $statement = $conn->stmt_init();

    // (iii) Prepare the template statement & test the result & check for SQL errors
    if (!$statement->prepare($sql)) {
      // ERROR: SQL Syntax error
      header("Location: ../register.php?error=sqlerror");
      exit();
    }
    // (iv) Bind the data to the statement & "typecast" the data
    $statement->bind_param("s", $username);

    // (v) Execute the query
    $statement->execute();

    // (vi) ONLY FOR READ QUERIES - Return the result
    $statement->store_result();
    $resultCheck = $statement->num_rows();
    if ($resultCheck > 0) {
      // ERROR: DUPLICATE USER
      header("Location: ../register.php?error=usertaken&mail=" . $email);
      exit();
    }

    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
    // Init statement
    $statement = $conn->stmt_init();
    // ERROR: Check prepared SQL statement for error in saving
    if (!$statement->prepare($sql)) {
      header("Location: ../register.php?error=sqlerror");
      exit();
    }

    // B. Statement execution
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $statement->bind_param("sss", $username, $email, $hashedPwd);
    if (!$statement->execute()) {
      // ERROR: Failed binding / execution
      header("Location: ../register.php?error=servererror");
      exit();
    } else {
      // SUCCESS: User signed up
      header("Location: ../index.php?signup=success");
      exit();
    }
  }

  // Closes statement & connection to db = saves memory!
  $statement->close();
  $conn->close();
} else {
  // 403 ERROR: FORBIDDEN
  header("Location: ../register.php?error=forbidden");
  exit();
}




?>


    