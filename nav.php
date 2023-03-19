<?php
session_start();
function currentPage($check)
{
  $current=explode('.',basename($_SERVER['PHP_SELF']));
  if($current[0]==$check)
  {
    echo 'nav-item active';
  }
  else
  {
    echo 'nav-item';
  }
}
?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">iTalk</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="<?php currentPage('index') ;?>">
        <a class="nav-link " href="index.php" target="_blank">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class=" <?php currentPage('About') ; ?>">
        <a class="nav-link" href="About.php" target="_blank">About</a>
      </li>
      <li class="<?php currentPage('#')?> dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
  <?php
  require 'dbconnect.php';
  echo'
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        ';
        $sql="select cname,sno from category LIMIT 4";
        $result=mysqli_query($conn,$sql);
        while($rows=mysqli_fetch_assoc($result))
        {
          echo'
         
          <a class="dropdown-item text-uppercase " id="category" 
          href="Thread.php?$cid='.$rows['sno'].'">'.$rows['cname'].'</a>
          
        ';
        }
    ?>
    </div></li>
      <li class="<?php currentPage('Contact') ;?>">
        <a class="nav-link" href="Contact.php" target="_blank">Contact</a>
      </li>
    </ul>
<?php
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
    {
    echo '
    <i class="fa fa-bell mx-2" style="width:30px;color:white;"  data-toggle="modal" data-target="#notificationModal">
    </i>
    <div class="dropdown mr-2">
    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
    <img src="logout.jpg" width="25px"></img>
    </button>
    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
    <span class="text-dark mr-1 pl-2 font-weight-bold" data-toggle="modal" data-target="#editProfileModal">'.$_SESSION['email'].'</span>
    <hr class="border-dark">
    <button type="button " class="dropdown-item " data-toggle="modal" data-target="#editProfileModal"><img src="images/editprofile.png" width="12px" class="mr-2">Edit Profile</button>
    <button type="button " class="dropdown-item " data-toggle="modal" data-target="#changePasswordModal"><img src="images/changepassword.jpg" width="12px" class="mr-2">Change Password</button>
    <a class="dropdown-item mb-1 text-danger " href="logout.php">Sign out</a>
    </div>
    </div>
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" id="search" type="submit">Search</button>
    </form>
    ';
    }
    else
    {
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      <button class="btn btn-success my-2 my-sm-0 ml-2"  type="button" data-toggle="modal" data-target="#signupModal">Sign Up</button>
      <button class="btn btn-success my-2 my-sm-0 ml-2" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
    </form>';
    }

  echo '</div>
</nav>';

include 'Modal/loginModal.php';
include 'Modal/signupModal.php'; 
include 'Modal/changePasswordModal.php';
include 'Modal/editProfileModal.php';
include 'Modal/notificationModal.php';
?>
