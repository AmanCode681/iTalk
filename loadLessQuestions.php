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

session_start();
require "dbconnect.php";
        $id=$_GET['id'];
        $nums_questions=$_GET['limit'];
        $total_rows=mysqli_num_rows(mysqli_query($conn,"select * from thread_ques where deleted=0"));
        $sql="select * from thread_ques where tcid=$id and deleted=0 order by dt desc limit 2 offset $nums_questions";
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        $output='';
        $result=mysqli_query($conn,$sql);
        while($rows=mysqli_fetch_assoc($result))
        {
          $noResult=false;
          $thread_user_id=$rows['tuserid'];
          $sql2="select `email` from `signup` where sno=$thread_user_id and deleted=0";
          $result2=mysqli_query($conn,$sql2);
          $rows2=mysqli_fetch_assoc($result2);
          $display="select `image` from `signup` where sno=$thread_user_id and deleted=0";
          $result3=mysqli_query($conn,$display);
          $rows3=mysqli_fetch_assoc($result3);
          $output.=
          '<div class="container">
          <div class="media">
          <img class="mr-3 rounded-circle my-1" src="'.$rows3["image"].'" width="60px" alt="Generic placeholder image">
          <div class="media-body">
          <p>Asked By: <b>'.$rows2['email'].'  at '.$rows['dt'].'</b></p>
          <h5 class="mt-0"><a href="threadsolve.php?$threadid='.$rows['tid'].'" class="text-dark">'.$rows['ttitle'].'</a></h5>
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
        if($nums_questions>0)
        {
            $cid=$_GET['id'];
            echo'
          <div class="flex">
        <button type="button"  id="prevflex" class="btn btn-outline-success" onclick="loadLessQuestions('.$cid.','.($nums_questions-2).')">prev</button>
        <button type="button"  id="nextflex" class="btn btn-outline-success" onclick="loadMoreQuestions('.$cid.','.($nums_questions+2).')">next</button>
        </div>
    </div>
    </div>';
        } 
        else
        {
          $cid=$_GET['id'];
            echo'
            <button type="button" id="nextbtn" class="btn btn-outline-success" onclick="loadMoreQuestions('.$cid.','.($nums_questions+2).')">next</button>
            </div>
            </div>';
        }
        ?>
    </div>