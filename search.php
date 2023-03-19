<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
  #outside{
      min-height:600px;
      position:relative;
  }
  h1{
    text-align:center;
  }
  h1::before{
    content:"     ";
    display:block;
    position:absolute;
    left:0px;
    top:4%;
    width:25%;
    border-bottom:2px solid green;
    background-color:green;
  }
  h1::after{
    content:"     ";
    display:block;
    position:absolute;
    right:0px;
    top:4%;
    width:25%;
    border-top:2px solid green;
    background-color:green;
  }
  </style>
    <title>Search</title>
  </head>
  <body class="">
  <?php
   require 'dbconnect.php';
   ?>
  <?php
   require 'nav.php';
   ?>
   <div class="container my-4" id="outside">
   <h1 id="header" class="text-success">Search Results for <b class="text-uppercase"><?php echo $_GET['search']; ?></b></h1>;
   <?php
   $query=$_GET['search'];
   $sql="select * from `thread_ques` where `ttitle` like '%$query%' or `tdesc` like '%$query%'";
   $result=mysqli_query($conn,$sql);
   $noResult=true;
   $result=mysqli_query($conn,$sql);
   
   while($rows=mysqli_fetch_assoc($result))
   {
     $noResult=false;
      echo '
      <div class="row my-1 mx-2">
        </p>
        <h2 class="text-dark"><a href="threadsolve.php?$threadid=1"class="text-info"> '.$rows['ttitle'].'</a></h2>
        <p class="text-secondary">
          '.$rows['tdesc'].'
        </p>
    </div>
      ';

   }
   if($noResult)
   {
     echo '
     <h1 id="header" class="text-dark">Your Search-<b class="text-uppercase">'.$_GET['search'].'</b>- did not match any documents.</h1>';
     echo '
     <div class="jumbotron jumbotron-fluid  my-3 mx-5 bg-white">
     <div class="container">
       <p class="lead text-dark7">Suggessions</p>
       <ul>
       <li class="lead text-dark">Make sure that all words are spell correctly.</li>
       <li class="lead text-dark">Try different keywords.</li>
       <li class="lead text-dark">Try more general words.</li>
       </ul>
     </div>
   </div>
     ';
   }
   ?>
    
   
   
   
   
   
   
   
   </div>

   <?php
    require 'Footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
    <script src="js/showhidepassword.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
    <script src="js/Notification.js"></script>
  </body>

</html>