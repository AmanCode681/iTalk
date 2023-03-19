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
    <title>iTalk</title>
    <style>
      .footer-icons{
       display:flex;
       justify-content:center;
      }
      .footer-icons a{
        display:block;
        width:2vw;
        color:white;
        border-radius:50%;
       background:#939596;
       text-align:center;
       font-size:100%;
       margin:0.3vw 1vw;
      }
    </style>
  </head>
  <body>
  <?php
    require 'dbconnect.php';
    ?>
    <?php
    require 'nav.php';
    ?>
    <?PHP
    if( isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true" )
    {
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success!</strong> You successfully Signup to our website.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
    
    }
    if( isset($_GET['signupfailure']) && $_GET['signupfailure']=="false" )
    {
      $err=$_GET['error'];
      echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Sorry! </strong>'.$err.'.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
    
    }
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
{
  echo '

  <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> You successfully Login to our website.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';
}
if( isset($_GET['loginFailed']) && $_GET['loginFailed']==true )
{
  $err=$_GET['error'];
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Sorry!</strong>'.$err .'.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';

}

if( isset($_GET['changePasswordSuccess']) && $_GET['changePasswordSuccess']=="true" )
{
  echo '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> You Password is changed successfully.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';

}
if(isset($_GET['changePasswordFailed']) && $_GET['changePasswordFailed']=="true")
{
  $error=$_GET['error'];
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Sorry! </strong>'.$error.'
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';
}
?>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active container-fluid my-2">
      <img class="d-block w-100" src="https://source.unsplash.com/1600x600/?coding,code" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://source.unsplash.com/1600x600/?coding,java" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://source.unsplash.com/1600x600/?coding,webdevelopmwnt" alt="Third slide">
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    </div>
      <div class="container my-1">
      <h2 class="text-center" id="move">iTalk-Browse Categories</h2>
      <div class="row">
        <?php
              $sql="select * from category";
              $result=mysqli_query($conn,$sql);
              while($rows=mysqli_fetch_assoc($result))
              {
                echo '<div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/300x200/?Coding,'.$rows['cname'].'" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title"><a style="color:black;" href="Thread.php?$cid='.$rows['sno'].'" target="_blank"><b>'.$rows['cname'].'</b></a></h5>
               <p class="card-text">'.substr($rows['cdesc'],0,100).'.....</p>
                <a href="Thread.php?$cid='.$rows['sno'].'" class="btn" style="background-color:orange;color:white;border-radius:10px">View Thread</a>
                </div>
                </div>
                </div> ';
              }
        ?>
          
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
    <script src="js/showhidepassword.js"></script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
    <script src="js/googleAccount.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
    <script src="js/Notification.js"></script>
  </body>
</html>