 
 

 <?php



  $servername = "localhost";
  $username = "root";
  $password = "root";
  // what is database name
  $dbname = "DogGrooming";

  // create connection with database - do database in msql

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die('<div class="alert role="alert"><h4>Connection failed:&#128520; </h4>' . $conn->connect_error . '</div>');
  }
  ?>

