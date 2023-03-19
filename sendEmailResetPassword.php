<?php
  session_start();
  require 'sendContactForm.php';
  require 'dbconnect.php';
    if(isset($_POST['resetEmail']))
    {
        $email=$_POST['resetEmail'];
        $sql="SELECT * FROM `signup` WHERE `email`='$email'";
        $count=mysqli_num_rows(mysqli_query($conn,$sql));
        if($count==1)
        {
          $message="<a href='http://localhost/Forum%20Project/resetPassword.php?email=$email' class='text-danger'>Click on the link to reset your password.</a>";
          $name=$email;
          if(sendEmail($email,$name,$message))
          {
            $showMsg="Click on the link on the email sent to change your password";
          }
        }
        else
        {
          $showMsg="Email does not exist!!";
        }
      echo $showMsg;
    }


  ?>