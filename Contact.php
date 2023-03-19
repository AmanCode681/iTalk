<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact</title>
    <link rel="stylesheet" href="CSS/contact.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Css/CategoryLink.css">
  </head>
  <body>
  <?php
    require 'dbconnect.php';
    ?>
   <?php
   require 'nav.php';
   ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="Alert" style="display:none">
    <div id="contactAlert" style="display:none"></div>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
  <?php 
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {
    echo'
   <div id="icons">
   <a href="http://www.facebook.com/profile.php?id=100024980462122" target="_aman" class="facebook">Click Here To Visit<i class="fa fa-facebook"></i></a>
   <a href="http://www.linkedin.com/in/aman-agarwal-5b572919a" target="_aman" class="linkedin">Click Here To Visit<i class="fa fa-linkedin"></i></a>
   <a href="http://www.instagram.com/agarwalaman681" class="instagram"target="_aman" >Click Here To Visit<i class="fa fa-instagram"></i></a>
   <a href="#" class="twitter" target="_aman">Click Here To Visit<i class="fa fa-twitter"></i></a>
   </div>

';
  }

?>
   <div id="outside">
   <div class="container my-5 ">
   <h1 class="text-dark text-center mt-2">Contact Form</h1>
   <h4 class="text-success text-center mt-2" id="result"></h4>
   <form method="POST" name="ContactForm"  id="ContactForm" >
   <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
  <?php 
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {
    $email=$_SESSION['email'];
  echo '
    <input type="email" class="form-control" name="email"  id="email" placeholder="'.$email.'" readonly>
  ';
  }
  else
  {
    echo'
    <p class="lead text-danger">You must be logged in to contact us</p>
    ';
  }
  ?>
  </div> 
  <div class="form-group" >
    <label for="feedback">Feedback</label>
    <textarea class="form-control"  id="feedback" name="feedback" rows="4" required></textarea>
  </div>
  <?php 
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {
    echo'
  <button type="submit" class="btn btn-success mb-5" name="submit" id="submit">Send</button>
  ';
  }
  ?>
  </form>
  </div>
  </div>
   <?php
    require 'Footer.php';
 ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
    <script src="js/Notification.js"></script>
    <script src="js/showhidepassword.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
    <script src="js/Contact.js"></script>
  </body>
</html>