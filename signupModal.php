<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:orange;color:white;">
        <h5 class="modal-title" id="signupModalLabel"><b>Signup To iDiscuss</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="handle_signup.php"  enctype="multipart/form-data">
      <div class="form-group">
      <label for="signupEmail">Email</label>
      <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" placeholder="Enter your Email" required>
      </div>
      <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="50" required>
      </div>
      <div class="form-group">
      <label for="cpassword">Confirm Password</label>
      <input type="cpassword" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" maxlength="25" required>
      </div>
      <div class="form-group">
      <label for="image">Upload Your Profile Photo</label>
      <input type="file" class="form-control" id="image" name="image" required>
      </div>
    <button type="submit" class="btn" style="background-color:orange;color:white;border-radius:10px">SignUp</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>