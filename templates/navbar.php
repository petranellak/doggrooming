<body>


  <section>
    <nav id="navbar">
      <div class="flex-container quicksandregular ">
        <img src="./images/smalllogo.webp" alt="dog face and scissor logo">
        <ul>


          <?php
          // LOGGED IN NAVLINKS
          if (isset($_SESSION['userId'])) {
            echo '<div class="alert "> Woofed On! </div>';
            // (i) Checks global $_SESSION variable to see if user is logged in & display Logout Button
            echo '<li >
              <form action="./includes/logout.inc.php" action = "POST">
                <button type="submit" class="btnlogout"  name="logout-submit">LOGOUT</button>
              </form>
            </li>

<li>
            <a class="btn" href="./index.php"> Home </a>
          </li>

          <li>
            <a class="btn" href="mailto:hello@doggrooming.com"> Say Woof!
            </a>
          </li>


            <Li>
            <a class="btn" href="./createpost.php"> Create Post
            </a>
          </li>

          <Li>
            <a class="btn" href="./posts.php"> Posts Page
            </a>
          </li>

          <li>
            <a class="btn" href="./booking.php"> Book Grooming
            </a>
          </li>

          <li>
            <a class="btn" href="./imagepush.php"> Upload Your Photos
            </a>
          </li>
            
            ';
          } else {
            // (ii) Display Login Button if no Session Variables



            // if (isset($_SESSION['userId'])) {
            //   // echo '<div class="alert alert-success quicksandregular " role="alert"> Woofed On!  </div>';
            // } else {
            //   echo 'Pls Login! &#9758;';
            // }


            echo '<li >
            <a class="btnlogin" href="./login.php">LOGIN
            </a>
          </li>

          <li>
            <a class="btnlogin" href="./register.php"> REGISTER
            </a>
          </li>
          
          <li>
            <a class="btn" href="./index.php"> Home </a>
          </li>

          <li>
            <a class="btn" href="mailto:hello@doggrooming.com"> Say Woof!
            </a>
          </li>

          
          ';
          }
          ?>


        </ul>


      </div>
    </nav>
  </section>