<?php
$check=false;
$notcheck=false;
$showerror="Invalid Credentials";
  require 'dbconnect.php';
$email=test_input($_POST['loginEmail']);
$password=test_input($_POST['password']);

$email=filter_var($email, FILTER_SANITIZE_STRING);
$password=filter_var($password, FILTER_SANITIZE_STRING);

 // Email validation
 if(!filter_var($email,FILTER_VALIDATE_EMAIL))
 {
 $showError="Invalid Email";
 header("location:index.php?loginFailed=true&error=$showerror");
  }
 // Password Validation
 if(!filter_var($email,FILTER_VALIDATE_STRING))
 {
 $showError="Invalid Password";
 header("location:index.php?loginFailed=true&error=$showerror");
  }


  if(!empty($email)  and !empty($password)  and preg_match("/^[a-zA-Z0-9 ]*/",$password) and filter_var($email, FILTER_VALIDATE_EMAIL))
  {
$sql="select * from `signup` where `email`='$email' and `deleted`=0";
$result=mysqli_query($conn,$sql);
$noofrows=mysqli_num_rows($result);
if($noofrows==1)
{
  while($rows=mysqli_fetch_assoc($result))
  {
    if(password_verify($password,$rows['password']))
    {
    $check=true;
    $notcheck=false;
    if(isset($_POST['rememberMe']))
    {
    setcookie('email', $email, time() + (86400 * 10), "/"); 
    setcookie('password', $password, time() + (86400 * 10), "/"); 
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['email']=$email;
    }
    else
    {
      session_start();
      $_SESSION['loggedin']=true;
      $_SESSION['email']=$email;
    }
    header("location:index.php?");
    exit();
   // echo 'Success';
    }
    else
    {
      $notcheck=true;
      $showerror="Password is incorrect";
    }
  }
}
else
{
    $notcheck=true;
    $showerror="Password or Email is incorrect";
}
  }
  else
  {
    $showerror="Please enter a required fields";
  }
header("location:index.php?loginFailed=true&error=$showerror");
//echo $showerror;
function test_input($data)
{
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
}
?>