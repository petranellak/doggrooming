<?php
// 1. Check user is logged in + has clicked the submit button
session_start();
if (isset($_POST['edit-submit']) && isset($_SESSION['userId'])) {
  // 2. Connect to db
  require './connection.inc.php';

  // 3. Store ALL available form & other data needed for query
  $id = $conn->real_escape_string($_GET['id']);
  $title = $_POST['title'];
  $imageUrl = $_POST['imageurl'];
  $comment = $_POST['comment'];
  $websiteUrl = $_POST['websiteurl'];


  // 4. Validate data for empty fields
  if (empty($id) || empty($title) || empty($imageUrl) || empty($comment) || empty($websiteUrl)) {
    header("Location: ../editpost.php?id=$id&error=emptyfields");
    exit();
  }

  // 5. Write prepared statement (5 steps) to update data in db posts
  // a. Declare template SQL - "sssssi"
  $sql = "UPDATE posts SET title=?,imageurl=?,comment=?,websiteurl=? WHERE id=?";

  // b. & c. Init & prep statement
  $statement = $conn->stmt_init();
  if (!$statement->prepare($sql)) {
    // ERROR: The template SQL has an error
    header("Location: ../editpost.php?id=$id&error=sqlerror");
    exit();
  }

  // d. Binding data
  $statement->bind_param("ssssi", $title, $imageUrl, $comment, $websiteUrl, $id);

  // e. Execute & test
  $statement->execute();
  if ($statement->error) {
    header("Location: ../editpost.php?id=$id&error=servererror");
    echo $statement->error;
    exit();
  }

  // SUCCESS: Edited post correctly!
  header("Location: ../posts.php?id=$id&edit=success");
  exit();
} else {

  header("Location: ../signup.php?error=forbidden");
  exit();
}
