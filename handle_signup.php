<?php
  include 'dbconnect.php';
        $email=test_input($_POST['signupEmail']);
        $password=test_input($_POST['password']);
        $cpassword=test_input($_POST['cpassword']);
        $image=$_FILES['image'];
        $destfile="images/".basename($image['name']);
        // Email validation
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
        $showError="Invalid Email";
        header("location:index.php?signupfailure=false&error=$showError");
        }
        // Password Validation
        if(!filter_var($email,FILTER_VALIDATE_STRING))
        {
        $showError="Invalid Password";
        header("location:index.php?signupfailure=false&error=$showError");
        }


        if(!empty($email)  and !empty($password) and !empty($cpassword) and preg_match("/^[a-zA-Z0-9 ]*/",$password) and preg_match("/^[a-zA-Z0-9 ]*/",$cpassword) and filter_var($email, FILTER_VALIDATE_EMAIL))
        {
        if(move_uploaded_file($image['tmp_name'],$destfile))
        {
        $email=filter_var($email, FILTER_SANITIZE_STRING);
        $password=filter_var($password, FILTER_SANITIZE_STRING);
        $cpassword=filter_var($cpassword, FILTER_SANITIZE_STRING);
        $showAlert=false;
        $pHash=password_hash($password,PASSWORD_DEFAULT);
        $sql="select * from `signup` where `email`='$email' or `password`='$pHash'";
        $result2=mysqli_query($conn,$sql);
        $numsRows=mysqli_num_rows($result2);
        if($numsRows>0)
        {
            $showError="Email or Password Already Exists!!! "; 
           header("location:index.php?signupfailure=false&error=$showError");
        }
       else
        {
            $passwordHash=password_hash($password,PASSWORD_DEFAULT);
            if(strcmp($password,$cpassword)==0)
            {
                $insert="insert into `signup`(`email`,`password`,`dt`,`image`,`deleted`) values ('$email','$passwordHash',now(),'$destfile',0)";
                $result=mysqli_query($conn,$insert);
                if($result==true)
                {
                    $showAlert=true;
                        ## Add Signup Notification
                        $emailsno=mysqli_query($conn,"select * from  signup where `email`='$email'");
                        while($r=mysqli_fetch_assoc($emailsno))
                        $sno=$r['sno'];
                        $nfor=$sno;
                        $nby=$sno;
                        $ndesc="You Successfully SignUp to our iTalk at";
                        $insertion=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`) values ('$ndesc',$nfor,$nby,now())");
                        if($insertion==false)
                        {
                            echo mysqli_error($conn);
                        }
                        ##
                        ##
                        $profileInsert=(mysqli_query($conn,"insert into `profile` (`emailsno`) values ($nfor)"));
                        if($profileInsert==false)
                        {
                            echo $e->getMessage();
                        }

                    echo "<script>$('#signupForm').reset()</script>";
                
                    header("location:index.php?signupsuccess=true");
                   exit();
                }
                else
                {
                    echo mysqli_error($conn);
                }
            }
            else
            {
                $showError="  Passwords Does not matches!! ";
                header("location:index.php?signupfailure=false&error=$showError");
            }
        }
    }
         else
        {
            $showError="  Image is not uploaded.Please Try Again!!! ";
        } 
    }
            else
            {
                $showError=" Please Enter a valid details";
            }
 header("location:index.php?signupfailure=false&error=$showError");
function test_input($data)
{
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
}
?>