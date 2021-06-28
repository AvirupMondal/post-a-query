<?php
include_once('includes/header.php');

?>
<div class="container">
  <div class="row login_mid"> 
    <div class="img-block col-lg-6 col-md-6">
      <img class="img-fluid  " src="images/bg1-01.png" alt="Login with your credentials">
    </div>

    <div class="loginform col-6">
      <h2>LogIn</h2>
      <form id="Login_form" method="post">

        <div class="inpuBox">
          <label>Email</label>
          <input type="email" name="user_email" id="login_email" required><br>
          <span class="field_error" id="email_error"></span>
        </div>
        

        <div class="inpuBox form-group">
          <label >Password</label>
          <input type="password" name="user_password" id="login_password" required><br>
          <span class="field_error" id="password_error"></span>
        </div>
        
        
        <div class="forget_password"><p><a href="forgetpassword.php">Forget Password?</a></p></div>
        <div>
          <button type="button" onclick="login_submit()" class="btn login-btn col-lg-6" value="Login" > LOGIN</button>
        </div>
        <div class="form-output login_msg">
					<p class="form-messege field_error"></p>
				</div>
        </form>
       
      <p>Not an User?<a href="signupwelcome.php"> SignUp</a></p>
    </div>
  </div>
</div>

  <?php 
 include_once('includes/footer.php');
 ?>

    
</body>
</html>