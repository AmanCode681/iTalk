<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Css/CategoryLink.css">
  <style>
  #outside{
    min-height:600px;
  }
  @media screen and (max-width:800px){
    h1,p,a{
      font-size:80%;
    }
  }
  </style>
    <title>About</title>
  </head>
  <body>
  <?php
   require 'dbconnect.php';
   ?>
  <?php
   require 'nav.php';
   ?>
   <div id="outside">
   <div class="container my-4" id="out">
   <h1 class="text-center"><b>For Developers,by developers</b></h1>
   <hr class="my-2 bg-success w-25 h-50">
   <p class="text-center text-dark mx-5" id="para">
   <b>iTALK</b> is an open community for anyone that codes. We help you get answers to your toughest coding questions, share knowledge with your coworkers in private, and find your next dream job.
   </p>
  </div>
<div class="container my-4" id="out">
   <h1 class="text-center"><b>For Businesses,by developers</b></h1>
   <hr class="my-2 bg-success w-25 h-50">
   <p class="text-center text-dark mx-5" id="para">
   Our mission is to help developers write the script of the future. This means helping you find and hire skilled developers for your business and providing them the tools they need to share knowledge and work effectively.
   </p>
</div>
<div class="container my-3">
<div class="row align-items-center justify-content-center">
<div class="card mx-4" style="width: 18rem;">
  <div class="card-body border border-success">
    <h5 class="card-title"></h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">Find the perfect candidate for your growing technical team with Talent solutions</p>
    <a href="Contact.php" target="_aman" class="card-link text-info">Click Here</a>
  </div>
</div>
<div class="card mx-4" style="width: 18rem;">
  <div class="card-body border border-success">
    <h5 class="card-title"></h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">Accelerate the discovery of your products or services through our Advertising platform</p>
    <a href="index.php" target="_aman" class="card-link text-info">Click Here</a>
  </div>
</div>
<div class="card mx-4 " style="width: 18rem;">
  <div class="card-body border border-success">
    <h5 class="card-title"></h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">Quickly find and share internal knowledge with <br> Q&A</p>
    <a href="Thread.php?$cid=1" target="_aman" class="card-link text-info ">Click Here</a>
  </div>
</div>
</div>
</div>
</div>
   <?php
    require 'Footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/Notification.js"></script>
    <script src="js/showhidepassword.js"></script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
   
  </body>

</html>