<?php
include_once('includes/header.php');
?>
  <div class="container-fluid">
    <div class="row signup_mid"> 

      <div class="img-block col-lg-4 offset-2">
        <img class="img-fluid rounded " src="images/login-img.jpg" alt="Login with your credentials">
      </div>

      <div class="signup col-lg-4 offset-1">
        <h2>Sign Up</h2>
        <form action="" method="post">
          <a href="studentsignup.php" class="btn btn-outline-primary col-lg-8" id="student"><em class="fas fa-user-graduate"></em> SignUp as Student</a>
          <a href="teachersignup.php" class="btn btn-outline-primary col-lg-8" id="teacher"><em class="fas fa-users"></em>  SignUp as Teacher</a>
        </form>
        <p>Already an User?<a href="login.php"> LogIn</a></p>
      </div>
    
     
        
        
    </div>
     
  </div>
  <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>