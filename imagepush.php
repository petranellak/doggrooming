<?php include './templates/header.php' ?>

<?php include './templates/navbar.php' ?>

<?php
$directory = "uploads";
$uploadOk = 1;
$uploadMessage = "";
$uploadMessageError = "";

$phpFileUploadErrors = array(
  0 => 'There is no error, the file uploaded with success',
  1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
  2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
  3 => 'The uploaded file was only partially uploaded',
  4 => 'No file was uploaded',
  6 => 'Missing a temporary folder',
  7 => 'Failed to write file to disk.',
  8 => 'A PHP extension stopped the file upload.',
);



// check if file submitted

if (isset($_POST['submit'])) {

  // declare file variables

  // / 1. DECLARE FILE VARIABLES
  $fileName = $_FILES['fileToUpload']['name'];  // myfile.jpg
  $fileTempName = $_FILES['fileToUpload']['tmp_name'];  // /tmp/php/php8hst23

  $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));  // jpg
  $allowedFiles = array('jpg', 'jpeg', 'png', 'gif', 'webp');

  $fileSize = $_FILES['fileToUpload']['size'];  // 82474
  $maxSize = 1024 * 1024 * 2; // 2MB


  // upload file to uplaods diectory

  $fileDownloadUrl = $directory . DIRECTORY_SEPARATOR . $fileName;

  // 2. VALIDATE THE FILE = allow image extensions (.jpg, .jpeg, .png, .gif, .webp)
  // a. Prevent duplicate file names being submitted
  $the_error = $_FILES['fileToUpload']['error'];
  if ($_FILES['fileToUpload']['error']) {
    $uploadMessageError = $phpFileUploadErrors[$the_error];
    $uploadOk = 0;
  }

  // b. Block non-allowed file exts (non-image files)
  if ($uploadMessageError == "" && !in_array($fileExt, $allowedFiles)) {
    $uploadOk = 0;
    $uploadMessageError = "File type is not allowed - please choose a jpg, jpeg, png, gif or webp &#128534;";
  }

  // c. Block large file sizes (> 2MB)
  if ($uploadMessageError == "" && $fileSize > $maxSize) {
    $uploadOk = 0;
    $uploadMessageError = "File is too large (2MB limit) &#128534;";
  }

  // 3. UPLOAD THE FILE TO "/UPLOADS" DIRECTORY
  if ($uploadOk == 0) {
    // ERROR STATE (block upload)
    $uploadMessage = "<p>Sorry, your file was not uploaded. &#128534;  <strong>Error: </strong>" . $uploadMessageError . "</p>";
  } else {
    // SUCCESS STATE (upload)
    if (move_uploaded_file($fileTempName, $directory . "/" . $fileName)) {
      $uploadMessage = "<p>File Uploaded! &#128054;  <strong>Preview it: </strong>
    <a href='" . $fileDownloadUrl . "' target='_blank'>" . $fileDownloadUrl . "</a></p>";
    }
  }
}

?>

<style>
  h2>span {
    font-weight: 800;
  }

  svg {
    color: orangered;
  }
</style>

<title>Upload Dog Photo!</title>



<div class="container ">
  <div class="text-center">
    <h2 class="heading">
      Image<span>Push</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cloud-arrow-up-fill mb-1" viewBox="0 0 16 16">
        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
      </svg>
    </h2>
    <p>Select image to upload:</p>
  </div>

  <div>
    <div>


      <form action="./imagepush.php" method="POST" enctype="multipart/form-data">
        <div>
          <!-- File Input -->

          <input type="file" class="form-control" id="inputGroupFile" name="fileToUpload">
          <!-- Submit Button -->
          <input type="submit" value="Upload" name="submit" class="btnloginpg">
        </div>

      </form>
      <!-- File Upload Form: START -->

      <!-- Alert Message -->
      <?php
      // F. Create Feedback to user in event of nothing, error or success
      if ($uploadMessage == "") {
        echo null;
      } else if ($uploadOk == 0) {
        echo '<div class="alert" role="alert">' . $uploadMessage . '</div>';
      } else {
        echo '<div class="alert" role="alert">' . $uploadMessage . '</div>';
      }
      ?>
    </div>
  </div>
</div>
</body>



<?php include './templates/footer.php' ?>