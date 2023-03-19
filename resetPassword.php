<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Recover Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Css/CategoryLink.css">
  </head>
 
  <style>
  body{
      margin:0px;
      padding:0px;
      box-sizing:border-box;
      height:100%;
  }
  </style>
 
  <body>
  
  <?php
    require 'dbconnect.php';
    ?>
   <?php
   require 'nav.php';
   ?>
   <?php
        require 'dbconnect.php';
    if(isset($_POST['submit']))
    {
        $email="agarwalanurag581@gmail.com";
        $newPassword=$_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];
        if($newPassword==$confirmPassword)
        {
            $passwordhash=password_hash($newPassword,PASSWORD_DEFAULT);
            $sql="update signup set `password`='$passwordhash' where `email`='$email'";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showMsg="Password Changed Successfully";
                // Add a notification
                $sql2=(mysqli_query($conn,"select * from `signup` where `email`='$email'"));
                while($row=mysqli_fetch_assoc($sql2))
                {
                    $emailsno=$row['sno'];
                }
                $insert=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`,`type`) values('$showMsg',$emailsno,$emailsno,now(),'!deleted')");
                if(!$insert)
                {
                    echo 'Failed'.mysqli_error($conn);
                }
            }
            else
            {
                echo 'Failed'.mysqli_error($conn);
            }
        }
        else
        {
            $showMsg="Passwords does not matches!!!";
        }
    }

   ?>
    <div class="container h-100 mt-5">
        <div class="row h-100 align-items-center justify-content-center mt-5">
            <div class="col-lg-5">
                <div class="card bg-light border-light">
                    <div class="header text-info font-weight-bold my-1">
                        <h4 class="text-center">Update Password</h4>
                    </div>
                    <div class="text-center text-danger mt-1"><?php if(isset($showMsg)){echo $showMsg ; }?></div>
                    <div class="body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ;?>" class="form px-3">
                            <div class="form-group">
                            <label for="exampleInputNewPassword">New Password</label>
                            <input type="password" class="form-control" name="newPassword" id="exampleInputNewPassword"  placeholder="Enter new password" required>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPassword" id="exampleInputConfirmPassword"  placeholder="Confirm new password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-info btn-md w-100"><h5>Change Password<h5></button>
                        </form>
                        <p class="text-dark mx-3 font-weight-italic my-2 text-center">Don't have a account yet,<a href="index.php">click here</a></p>
                        <p class="text-dark mx-3 font-weight-italic my-2 text-center">Already have a account yet,<a href="index.php">click here</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div style="height:320px;"></div>
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
    <script src="js/Notification.js"></script>
    <script src="js/showhidepassword.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
  </body>
</html>