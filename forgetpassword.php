<?php
include_once('includes/header.php');
?>

  <div class="container-fluid">
    <div class="row"> 

      <div class="img-block col-lg-4 offset-2">
        <img class="img-fluid rounded " src="images/login-img.jpg" alt="Login with your credentials">
      </div>

      <div class="forgetpasswordform col-lg-4 offset-1">
        <h3>Forget Password</h3>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Email</label>
            <input type="email" name="user_email" id="login_email">
          </div>
          
          <button type="submit" class="btn btn-outline-primary" id="forgetpasswordsubmit"> Submit</button><br>
          
        </form>
      <a href="login.php"> Login</a> 
      </div>
    
     
        
        
    </div>
     
  </div>
  <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>