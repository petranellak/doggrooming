<?php include './templates/header.php' ?>


<?php include './templates/navbar.php' ?>


<main>


  <?php
  // A. FORM PRE-POPULATION
  if (isset($_SESSION['userId']) && isset($_GET['id'])) {
    require './includes/connection.inc.php';

    $row;
    $id = $conn->real_escape_string($_GET['id']);

    // PREPARED STATEMENTS - select by id
    // 1. Template SQL
    $sql = "SELECT title, imageurl, comment, websiteurl FROM posts WHERE id=?";

    // 2. & 3. Init the SQL & Prepare the Template SQL
    $statement = $conn->stmt_init();
    if (!$statement->prepare($sql)) {
      // ERROR: The template SQL has an error
      header("Location: ./editpost.php?id=$id&error=sqlerror");
      exit();
    }

    // 4. Bind data to the template
    $statement->bind_param("i", $id);

    // 5. & 6. Execute the query & retrieve the data
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
  } else {
    header("Location: ./index.php?error=edit-forbidden");
    exit();
  }
  ?>

  <div class="container">
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
      <h2 class="heading">Edit Your Post</h2>

      <?php
      // 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
      if (isset($_GET['error'])) {

        // (i) Empty fields validation 
        if ($_GET['error'] == "emptyfields") {
          $errorMsg = "Please fill in all fields &#128534";

          // (vii) Internal server error 
        } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
          $errorMsg = "An internal server error has occurred - please try again later &#128534";

          // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
        }
        echo '<div class="alert" role="alert">' . $errorMsg . '</div>';
        // 2. SUCCESS MESSAGE: Go to posts.php
      }
      ?>

      <!-- 1. TITLE - will become name or monikor -->
      <div class="emaillogin">
        <label for="title" class="form-label">Title</label>
        <input
          type="text"
          class="form-control"
          name="title"
          placeholder="Title"
          value="<?php echo $row['title']; ?>">
      </div>

      <!-- 2. IMAGE URL  - will become topic you want to discuss-->
      <div class="emaillogin">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['imageurl']; ?>">
      </div>

      <!-- 3. COMMENT SECTION -->
      <div>
        <label for="comment" class="form-label">Comment</label>
        <textarea
          class="form-control"
          name="comment"
          rows="3"
          placeholder="Comment"><?php echo $row['comment']; ?></textarea>
      </div>

      <!-- 4. WEBSITE URL - this is the website or image url-->
      <div class="emaillogin">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" class="form-control" name="websiteurl" placeholder="Website URL" value="<?php echo $row['websiteurl']; ?>">
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="edit-submit" class="btnloginpg">Edit</button>
    
    </form>

<div id="collie">
      <img src="./images/browndog.webp" alt="collie medium hair clip">
    </div>
    
</main>

<?php include './templates/footer.php' ?>