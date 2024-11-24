<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>


<main >

<div class="container">
<form action="includes/createpost.inc.php" method="POST">
<h2 class="heading">Create Post</h2>

<?php
    // 1. VALIDATION: If error/success in $_GET - dsiplay appropriate message
    if(isset($_GET['error'])){
      // (i) Empty fields validation 
      if($_GET['error'] == "emptyfields"){
        $errorMsg = "Please fill in all fields &#128534";

      // (ii) Forbidden request
      } else if ($_GET['error'] == "forbidden") {
        $errorMsg = "Please submit the form correctly &#128534";

      // (iii) 500 Internal server error (sql or server)
      } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error has occurred - please try again later &#128534";
      }

      // (iv) ERROR CATCH-ALL:
      echo '<div class="alert" role="alert">' . $errorMsg . '</div>';

      // (iv). SUCCESS MESSAGE: Post saved successfully to DB -> NOT on this page.  We redirect them to posts.php, so we will need to add it there LATER!
    }
  ?>


  
  <!-- <section class="grid-container formgroom>"
  <section class="grid-container-1 "> -->
  

    <!-- 1. TITLE -->
    <div class="emaillogin">
      <label for="title" class="form-label"></label>
      <input type="text" class="form-control" name="title" placeholder="Title" value="">
    </div>

    <!-- 2. IMAGE URL -->
    <div class="emaillogin">
      <label for="imageurl" class="form-label"></label>
      <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="">
    </div>

    <!-- 3. COMMENT SECTION -->
    <div>
      <label for="comment" class="form-label"></label>
      <textarea class="form-control" name="comment" rows="3" placeholder="Comment"></textarea>
    </div>

    <!-- 4. WEBSITE URL -->
    <div class="emaillogin">
      <label for="websiteurl" class="form-label"></label>
      <input type="text" class="form-control" name="websiteurl" placeholder="Website URL" value="">
    </div>


    <!-- 6. SUBMIT BUTTON -->
    <button type="submit" name="post-submit" class="btnloginpg">Post</button>
  </form>

  
<div id="collie">
<img src="./images/browndog.webp" alt="collie medium hair clip"> 
</div>


</div>


</main>

<?php include './templates/footer.php' ?>



      

       

    
      
     

