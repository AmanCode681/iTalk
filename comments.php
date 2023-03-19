<?php
      session_start();
        require 'dbconnect.php';
        $id=$_GET['id'];
        $limit=$_GET['limit'];
        $total_rows=mysqli_num_rows(mysqli_query($conn,"select * from `comments` where deleted=0 "));
        $limit=$limit+2;
        if($limit>=$total_rows)
        {
          $btntext="No More Comments";
          $limit=$total_rows;
          echo
                '<div class="jumbotron">
                <div class="container mx-4">
                  <h1 class="display-4">No Comments Yet</h1>
                  <p class="lead"><b>Be the first person to post the Comment.</b></p>
                </div>
              </div>';
        }
        else
        {
          
          $btntext="Load More Comments";
        $sql="select * from comments where tid= $id and deleted=0 ORDER BY `dt` DESC LIMIT $limit";
        $result=mysqli_query($conn,$sql);
        $nums_rows=mysqli_num_rows($result);
        while($rows=mysqli_fetch_assoc($result))
        {
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
        <button type="button"   class="btn mb-1 mx-2"   id="like" onclick="reaction (this,'.$rows['cmtid'].',\'like\')"><img src="like.jpg" width="20px" ></img></button>
        <span class="lead text-dark">'.$no_of_like_per_id .'</span>
        <button type="button" class="btn mb-1 ml-4"  id="dislike" onclick="reaction(this,'.$rows['cmtid'].',\'dislike\')"><img src="dislike.jpg" width="20px"></img></button>
        <span class="lead text-dark ml-2">'.$no_of_dislike_per_id .'</span>
        <button id="report" >Report</button>
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
      }
        /*if($total_rows<=0)
        {
          echo
                '<div class="jumbotron">
                <div class="container mx-4">
                  <h1 class="display-4">No Comments Yet</h1>
                  <p class="lead"><b>Be the first person to post the Comment.</b></p>
                </div>
              </div>';
        }*/
    ?>
    <?php
    if($btntext=='Load More Comments')
       echo '<button type="button"  class="btn btn-md bg-dark text-white my-4" onclick="loadMoreComments('.$limit.','.$_GET['id'].')" >Load More Comments</btn>
        </div>';
    else
    echo '<button type="button"  class="btn btn-md bg-dark text-white my-4" >No More Comments</btn>
    </div>';
        
    ?>    
       
    
        
