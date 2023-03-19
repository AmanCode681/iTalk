
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
    <title>iTALK</title>
  </head>
  <style>
    .flex{
      display:flex;
      flex-direction:row;
      align-items:center;
      justify-content:center;
      align-content:center;
      margin-left:550px;
      margin-right:550px;
      margin-bottom:15px;
      
    }
    #nextflex{
      flex:2;
      width:100px;
      text-transform:capitalize;
      font-size:150%;
      margin-left:10px;
    }
    #prevflex{
      flex:2;
      width:100px;
      text-transform:capitalize;
      font-size:150%;
    }
    #nextbtn{
     margin-left:1150px;
     margin-bottom:10px;
     width:100px;
     font-size:150%;
     text-transform:capitalize;
    }
    #prevbtn{
     margin-left:110px;
     margin-bottom:10px;
     width:100px;
     font-size:150%;
     text-transform:capitalize;
    }
    #disablebtn{
      margin-left:1110px;
     margin-bottom:10px;
     width:130px;
     border:1px solid green;
     color:white;
     text-transform:capitalize;
     font-size:150%;
     border-radius:15px;
      background-color:green;
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
    $showLoggedError=false;
      if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
      {
      if($_SERVER['REQUEST_METHOD']=='POST')
      {
        $title=test_input($_POST['title']);
        $desc=test_input($_POST['desc']);
        $title=filter_var($title, FILTER_SANITIZE_STRING);
        $desc=filter_var($desc, FILTER_SANITIZE_STRING);
        $id=$_GET['$cid'];
        ## category name
        $category=mysqli_query($conn,"select * from `category` where `sno`=$id");
        while($c=mysqli_fetch_assoc($category))
        {
          $cname=$c['cname'];
        }

        ##
        $email=$_SESSION['email'];
        if(preg_match("/^[a-zA-Z0-9 ]*/",$title) &&  preg_match("/^[a-zA-Z0-9 ]*/",$desc) and !empty($title) and !empty($desc))
        {
        $select="select sno from `signup` where `email`='$email' and `deleted`=0";
        $result3=mysqli_query($conn,$select);
        $row=mysqli_fetch_assoc($result3);
        $cmtby=$row['sno'];
        $sql="insert into `thread_ques`(`ttitle`,`tdesc`,`tcid`,`tuserid`,`dt`,`deleted`) values('$title','$desc','$id','$cmtby',now(),0)";
        $result=mysqli_query($conn,$sql);
        if($result==true)
         {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You Question is Successfully Posted.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        ## Notification for Posting Questions

        $nfor=$cmtby;
        $nby=$cmtby;
        $ndesc="You posted the question on  $cname category on";
        $check=mysqli_num_rows(mysqli_query($conn,"Select * from `notifications` where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=nby"));
            if($check==0)
            {
                $insertion=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`) values ('$ndesc',$nfor,$nby,now())");
                if($insertion==false)
                {
                    echo mysqli_error($conn);
                }
            }
            else
            {
                $updation=mysqli_query($conn,"update `notifications` set `dt`=now() where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=$nby");
                if($updation==false)
                {
                    echo mysqli_error($conn);
                }
            }

        ##

         }
        else
          {
          echo "failed".mysqli_error();
          }
        }
        else
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong>  Please enter a valid title or desc.
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
     <strong></strong> You are not loggedin.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
    }
    ?>
    <?php
    $id=$_GET['$cid'];
    $sql="select * from category where sno=$id";
    $result=mysqli_query($conn,$sql);
    while($rows=mysqli_fetch_assoc($result))
    {
    echo '<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to '.$rows['cname'].' forums</h1>
        <p class="lead">'.$rows['cdesc'].'</p>
        <hr class="my-4">
        <p>No Spam / Advertising / Self-promote in the forums.
        Do not post copyright-infringing material.
        Do not post “offensive” posts, links or images.
        Do not cross post questions.
        Do not PM users asking for help.
        Remain respectful of other members at all times.</p>
        <p class="lead">
        </p>
        <p class="lead">
  
        </p>
    </div>
</div>';
    }
    ?>
     <div id="questions">
    <div class="container">
    <h3>Log In To Start a Discussion</h3>
    <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">
  <div class="form-group">
    <label for="title">Question Title</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter your title" required>
    <small id="help" class="form-text text-muted">Keep your title as breif as you could be.</small>
  </div>
  <div class="form-group">
    <label for="desc">Description of Your Problem</label>
    <textarea class="form-control" name="desc" id="desc" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
        <div class="container my-4" style="min-width:433px;">
        <h1 class="mr-4">Browse Questions:</h1>
        <?php
        $id=$_GET['$cid'];
        $total_rows=mysqli_num_rows(mysqli_query($conn,"select * from thread_ques where deleted=0"));
        $total_no_rows=mysqli_num_rows(mysqli_query($conn,"select * from thread_ques where tcid=$id and deleted=0"));
        if($total_rows<2)
        {
          $nums_questions=$total_rows;
        }
        else
        {
          $nums_questions=2;
        }
        $sql="select * from thread_ques where tcid=$id and deleted=0 order by dt desc limit $nums_questions";
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        $output='';
        $result=mysqli_query($conn,$sql);
        while($rows=mysqli_fetch_assoc($result))
        {
          $noResult=false;
          $thread_user_id=$rows['tuserid'];
          $sql2="select `email` from `signup` as s where s.sno=$thread_user_id and s.deleted=0";
          $result2=mysqli_query($conn,$sql2);
          $rows2=mysqli_fetch_assoc($result2);
          $display="select `image` from `signup` as s where s.sno=$thread_user_id and s.deleted=0";
          $result3=mysqli_query($conn,$display);
          $rows3=mysqli_fetch_assoc($result3);
          $output.=
          '<div class="container">
          <div class="media">
          <img class="mr-3 rounded-circle my-1" src="'.$rows3["image"].'" width="60px" alt="Generic placeholder image">
          <div class="media-body">
          <p>Asked By: <b>'.$rows2['email'].'  at '.$rows['dt'].'</b></p>
          <h5 class="mt-0"><a href="threadsolve.php?$threadid='.$rows['tid'].'" target="_blank" class="text-dark">'.$rows['ttitle'].'</a></h5>
          <p>'.$rows['tdesc'].'</p>
          </div>
          </div>
          <hr class="bg-dark">
          </div>';
        }
        echo $output;
        ?>
        </div>
        <?php
            if($noResult)
            {
                echo
                
                '<div class="jumbotron" style="margin-left:115px;margin-right:115px;">
                <div class="container">
                  <h1 class="display-4">No Question Yet</h1>
                  <p class="lead"><b>Be the first person to post the question.</b></p>
                </div>
              </div>';
            }
        ?>
        <?php
        $cid=$_GET['$cid'];
        if($noResult==false)
        {
       echo' 
        <button type="button" id="nextbtn" class="btn btn-outline-success" onclick="loadMoreQuestions('.$cid.','.$nums_questions.')">next</btn>
        </div>
        </div>';
        }
        ?>
        <?php
              require 'Footer.php';
        ?>  


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/Thread.js"></script>
    <script src="js/signupFormValidation.js"></script>
    <script src="js/loginFormValidation.js"></script>
    <script src="js/showhidepassword.js"></script>
    <script src="js/loginshowhidepassword.js"></script>
    <script src="js/Notification.js"></script>
   
    <script>
    function loadLessQuestions(id,questionscount)
  {
    var xhr=new XMLHttpRequest();
    var cid=id;

    xhr.onload =function()
    {
      if(this.status==200)
      {
        document.getElementById('questions').innerHTML=this.responseText;
      }
    }
  
    xhr.open("GET","loadLessQuestions.php?id=" + cid +"&limit=" +  questionscount,true);
    xhr.send();
  }
      
    </script>
  </body>
</html>