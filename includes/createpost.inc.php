<?php
session_start();
if (isset($_POST['post-submit']) && isset($_SESSION['userId'])) {
  // Connection
  require './connection.inc.php';

  // Store form data in local var
  $title = $_POST['title'];
  $imageUrl = $_POST['imageurl'];
  $comment = $_POST['comment'];
  $websiteUrl = $_POST['websiteurl'];


  // 1. VALIDATION: Check for empty fields
  if (empty($title) || empty($imageUrl) || empty($comment) || empty($websiteUrl)) {
    header("Location: ../createpost.php?id=$id&error=emptyfields");
    exit();
  }

  // 2. PREPARED STATEMENTS: Insert posts data into posts table
  // [a] Templating
  $sql = "INSERT INTO posts(id, title, imageurl, comment, websiteurl) VALUES (NULL,?,?,?,?)";
  $statement = $conn->stmt_init();
  if (!$statement->prepare($sql)) {
    // ERROR: The template SQL has an error
    header("Location: ../createpost.php?error=sqlerror");
    exit();
  }

  // [b] Execution
  $statement->bind_param("ssss", $title, $imageUrl, $comment, $websiteUrl);
  $statement->execute();

  // 3. REDIRECT USER ON SUCCESS: Go to posts.php page
  if ($statement->error) {
    header("Location: ../createpost.php?error=servererror");
    exit();
  }

  // Success Post
  header("Location: ../posts.php?post=success");
  exit();
} else {
  header("Location: ../createpost.php?error=forbidden");
  exit();
}
