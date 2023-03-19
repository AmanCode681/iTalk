<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Css/CategoryLink.css">
    <title>iTALK</title>
    <style>
      #report{
        background-color:none;
        text-align:center;
        font-size:120%;
        margin-left:35px;
        border:2px solid red;
        color:red;
        border-radius:5px;
        text-transform:uppercase;
      }
      #report:hover{
        background-color:red;
        color:white;
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
    
     <?php
      $showLoggedError=false;
   if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
   {
   if($_SERVER['REQUEST_METHOD']=='POST')
   {
     $cmtdesc=test_input($_POST['cmtdesc']);
     //$cmtdesc=filter_var($cmtdesc, FILTER_SANITIZE_STRING);
     $id=$_GET['$threadid'];
     $email=$_SESSION['email'];
     if(preg_match("/^[a-zA-Z0-9 ]*/",$cmtdesc) and !empty($cmtdesc))
     {
     $select="select sno from `signup` where `email`='$email' and deleted=0 ";
     $result3=mysqli_query($conn,$select);
     $row=mysqli_fetch_assoc($result3);
     $cmtby=$row['sno'];
     $sql="insert into `comments`(`cmtdesc`,`tid`,`cmtby`,`dt`,`deleted`) values('$cmtdesc','$id','$cmtby',now(),0)";
     $result=mysqli_query($conn,$sql);
     if($result==true)
      {
        // notification for comments
        $query=mysqli_query($conn,"select * from `signup` where `email`='$email'");
        while($r=mysqli_fetch_assoc($query))
        {
            $sno=$r['sno'];
        }
        // thread ques
        $check=mysqli_query($conn,"select * from thread_ques where  `tid`=$id");
        while($c=mysqli_fetch_assoc($check))
        {
          $title=$c['ttitle'];
        }
        //insert notification
        $ndesc="Hey, you commented on <strong>$title</strong> on";
        $nfor=$sno;
        $nby=$sno;
        $insert=mysqli_query($conn,"insert into `notifications`(`ndesc`,`nfor`,`nby`,`dt`,`type`) values ('$ndesc',$sno,$sno,now(),'!deleted')");
        if($insert=false)
        {
            echo mysqli_error($conn);
        }
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> You Comment is Successfully Posted.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';
      }
     else
       {
       echo "failed".mysqli_error();
       }
      }
      else
      {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>Sorry!</strong>Please enter a valid Comment.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>';
      }
    }
    $showLoggedError=true;
    }
    function test_input($data)
    {
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
    }
 ?>


<?php
    if($showLoggedError==false)
    {
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong></strong> You must be logged in to post a comment.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
    }
?>
    <?php
    $id=$_GET['$threadid'];
    $sql="select * from thread_ques where tid=$id and deleted=0 ";
    $result=mysqli_query($conn,$sql);
    while($rows=mysqli_fetch_assoc($result))
    {
      $thread_user_id=$rows['tuserid'];
      $sql2="select `email` from `signup` where sno=$thread_user_id and deleted=0 ";
      $result2=mysqli_query($conn,$sql2);
      $rows2=mysqli_fetch_assoc($result2);
    echo '<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4">'.$rows['ttitle'].'</h1>
        <p class="lead">'.$rows['tdesc'].'</p>
        <hr class="my-4">
        <p>No Spam / Advertising / Self-promote in the forums.
        Do not post copyright-infringing material.
        Do not post “offensive” posts, links or images.
        Do not cross post questions.
        Do not PM users asking for help.
        Remain respectful of other members at all times.</p>
        <p class="lead">
        Posted By :<b>'.$rows2['email'].' at '.$rows['dt'].'</b>
        </p>
    </div>
</div>';
    }
    ?>
    <?php
        function no_of_comments()
        {
          require 'dbconnect.php';
          $no_of_comments=mysqli_num_rows(mysqli_query($conn,"select * from `comments` where deleted=0 "));
          return $no_of_comments;
        }
    ?>
     
      <div class="container">
    <h3>Log In To Post a Comment</h3>
    <form method="POST" id="PostComment" action="<?php echo $_SERVER['REQUEST_URI']?>">
  <div class="form-group">
    <label for="cmtdesc">Write Your Comment Below:</label>
    <textarea class="form-control" name="cmtdesc" id="cmtdesc" rows="3" placeholder="Enter the public comment here....." required></textarea>
  </div>
  <button type="submit" class="btn btn-success" >Post A Comment</button>
</form>
    </div>
    
        <div class="container my-4">
        <h1 class="mr-4 text-uppercase"><?php require 'dbconnect.php';
          $tid=$_GET['$threadid'];
          $no_of_comments=mysqli_num_rows(mysqli_query($conn,"select * from `comments` where `tid`=$tid and deleted=0 "));
          if($no_of_comments!=0)
          {
          echo $no_of_comments;
          }
          else
          {
            echo '0';
          }
          ?> Comments</h1>
        <div id="comments">
        <?php
        $id=$_GET['$threadid'];
        $total_rows=mysqli_num_rows(mysqli_query($conn,"select * from `comments` where deleted=0 "));
        if($total_rows<=2)
        {
          $nums_rows=$total_rows;
        }
        else
        {
          $nums_rows=2;
        }
        $sql="select * from comments where tid=$id  and deleted=0 ORDER BY `dt` DESC Limit $nums_rows";
        $result=mysqli_query($conn,$sql);
        //$nums_rows=mysqli_num_rows($result);
        $total_no_rows=mysqli_num_rows(mysqli_query($conn,"select * from comments where tid=$id and deleted=0 "));
        $noResult=true;
        while($rows=mysqli_fetch_assoc($result))
        {
         $noResult=false;
         $thread_user_id=$rows['cmtby'];
         $sql2="select `email` from `signup` where sno=$thread_user_id and deleted=0 ";
         $result2=mysqli_query($conn,$sql2);
         $rows2=mysqli_fetch_assoc($result2);
         $display="select `image` from `signup` where sno=$thread_user_id and deleted=0 ";
          $result3=mysqli_query($conn,$display);
         
          $rows3=mysqli_fetch_assoc($result3);
          $cmtid=$rows['cmtid'];
         $no_of_like_per_id =mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `type`='like' and `cmtid`=$cmtid "));
         $no_of_dislike_per_id =mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `type`='dislike' and `cmtid`=$cmtid "));
          if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
          {
          echo '
        <div class="media mb-2 px-2 py-1" style="border:2px solid grey;border-radius:10px;">
        <img class="mr-3 my-2 rounded-circle" src="'.$rows3["image"].'" width="80px" alt="Generic placeholder image">
        <div class="media-body">
        <p><b> Commented By: '.$rows2['email']. ' at '.$rows['dt'].'</b><br>'.$rows['cmtdesc'].' </p>
        <button type="button"  class="btn mb-1 mx-2" id="like" onclick="reaction (this,'.$rows['cmtid'].',\'like\')"><img src="like.jpg" width="25px" ></img></button>
        <span class="lead text-dark ml-2">'.$no_of_like_per_id .'</span>
        <button type="button" class="btn mb-1 ml-4" id="dislike" onclick="reaction(this,'.$rows['cmtid'].',\'dislike\')"><img src="dislike.jpg" width="25px"></img></button>
        <span class="lead text-dark ml-2">'.$no_of_dislike_per_id .'</span>
        </div>
        </div>
            ';
          }
          else
          {
            echo'
            <div class="media mb-2 px-2" style="border:2px solid grey;border-radius:10px;">
            <img class="mr-3 my-2 rounded-circle" src="'.$rows3["image"].'" width="80px" alt="Generic placeholder image">
            <div class="media-body">
            <p><b> Commented By: '.$rows2['email']. ' at '.$rows['dt'].'</b><br>'.$rows['cmtdesc'].' </p>
            </div>
            </div>';
          }
        }
          
        if($noResult)
         {
                echo
                '<div class="jumbotron">
                <div class="container mx-4">
                  <h1 class="display-4">No Comments Yet</h1>
                  <p class="lead"><b>Be the first person to post the Comment.</b></p>
                </div>
              </div>';
         }
         ?>
         <?php
         if($total_no_rows>2)
         {
           $tid=$_GET['$threadid'];
           echo'
          <button type="button" id="loadbtn" class="btn btn-md bg-dark text-white my-4" onclick="loadMoreComments('.$nums_rows .','.$tid.')">Load More Comments</button>
        </div>';
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
    <script src="js/Threadsolve.js">
    </script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
      <script src="js/showhidepassword.js"></script>  
      <script src="js/loginshowhidepassword.js"></script>
      <script src="js/Notification.js"></script>
  </body>
</html>