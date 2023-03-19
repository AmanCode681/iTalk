
<?php
require 'sendContactForm.php';
session_start();
if(isset($_POST['name']))
{
    require "dbconnect.php";
    $name=test_input($_POST['name']);
    $email=test_input($_SESSION['email']);
    $feedback=test_input($_POST['feedback']);
    if(preg_match("/^[a-zA-z0-9]*/",$name) and preg_match("/^[a-zA-z0-9]*/",$feedback) and !empty($name) and !(empty($feedback)))
    {
    $insert="insert into `contact`(`name`,`email`,`feedback`,`dt`,`deleted`)values('$name','$email','$feedback',now(),0)";
    $sql=mysqli_query($conn,$insert);
    $message="<h6 style='color:green;'>Hi $name ,we have recieved your feedback form and will contact you soon.</h6>";
    if($sql and sendEmail($email,$name,$message)==true)
    {
        $showMsg='We will contact you soon';
        ## Notification for contact form filled
        $emailsno=mysqli_query($conn,"select * from `signup` where `email`='$email'");
        while($r=mysqli_fetch_assoc($emailsno))
        {
        $cmtby=$r['sno'];
        }
        $nfor=$cmtby;
        $nby=$cmtby;
         $ndesc="We have recieve your feedback and will contact you soon on";
                 $insertion=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`) values ('$ndesc',$nfor,$nby,now())");
                 if($insertion==false)
                 {
                     echo mysqli_error($conn);
                 }

        ##
         //header("location:Contact.php?success=true&msg=$showMsg");

    }
    else
    {
        $showMsg="failed to submit";
        echo mysqli_error($conn);
    }  
    }
    else
    {
         $showMsg="Please enter a valid name or feedback";
          
    }

}
else
{
    $showMsg="You must be logged in to submit feedback form";
    
   
}
echo $showMsg;
//header("location:Contact.php?failure=true&msg=$showMsg");
function test_input($data)
{
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
}

?>
