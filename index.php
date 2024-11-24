<?php include './templates/header.php' ?>
<?php include './templates/navbar.php' ?>


<?php
// Checks the $_SESSION for user variable
if (isset($_SESSION['userId'])) {
  echo '<div class="alert" role="alert">You are logged in! &#129392;</div>';
} else {
  echo '<div class="alert" role="alert">You are not logged in! &#128565; </div>';
}
?>

<section id="indexhero">


  <div class="tx-flex  flex-container">

    <div class="logomain">
      <h1 class="alata">Dog + I </h1>
      <h2 class="heading"> Grooming & Coffee </h2>
      <br>
      <img src="./images/logomain.webp" alt="dog face and scissor logo">
    </div>


    <div>
      <img class="wavy-box" src="./images/indexbwdog.webp " alt="dogs being friends">
    </div>

  </div>

</section>



<section id="parkready" class="tx-flex">

  <div class="quicksandregular">




    <h2>Get Park Ready!</h2>


  </div>

  <div class="paragraph">
    <p> We all want to look out best meeting friends and our dogs are no different. Bring your dog in for a bespoke clip today! Follow our social media below. </p>
  </div>

  <div class="logoword">
    <img src="./images/logoword.webp" alt="">
  </div>


</section>




<?php include './templates/footer.php' ?>