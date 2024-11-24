<?php
  // 1. Check User is Logged In + Id passed in via GET
  // NOTE: ESSENTIAL that user is logged in before they can delete (this is known as proper authorisation!) 
  session_start();
  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // 3. Connect to DB
    require './connection.inc.php';

    // 4. Collect, escape string & store POST data
    // OOP CLASS: MYSQLI - https://www.php.net/manual/en/class.mysqli.php
    $id = $conn->real_escape_string($_GET['id']); 
    $id = intval($id);

    // 6. Delete Post from DB (Prepared Statements)
    // NOTE: As we are getting data from the user, we want to use PREPARED STATEMENTS to ward against sql injections
    // (i) Declare Template SQL with ? Placeholders to delete values from table
    $sql = "DELETE FROM posts WHERE id=?"; 

    // (ii) Init SQL statement
    // OOP CLASS: MYSQLI_STMT - https://www.php.net/manual/en/class.mysqli-stmt.php
    $statement = $conn->stmt_init();

    // (iii) Prepare + send statement to database to check for errors
    if(!$statement->prepare($sql)){
      // ERROR: Something wrong when preparing the SQL
      // NOTE: Need to pass in the id BACK to url & the error message
      header("Location: ../posts.php?id=$id&error=sqlerror"); 
      exit();
    } 

    // (iv) SUCCESS: Bind our user data with statement + escape integer
    // NOTE: We bind ONE integer!
    $statement->bind_param("i", $id);

    // (v) Execute the SQL Statement (to run in DB)
    $statement->execute();
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../posts.php?error=servererror");
      exit();
    }
    
    // (vi) SUCCESS: Post is deleted from "posts" table - redirect with success message
    header("Location: ../posts.php?id=$id&delete=success"); 
    exit();

  // 2. Restrict Access to Script Page
  // NOTE: For example, to access this script, user MUST be LOGGED IN
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>