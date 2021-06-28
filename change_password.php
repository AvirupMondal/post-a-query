<?php
include_once('includes/header.php');
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
 
  $Id=get_safe_data($con,$_GET['id']);
  
 $sqli="Select * from users where id='$Id'";
 $res=mysqli_query($con,$sqli);
  $check=mysqli_num_rows($res);
  if($check >0){
    $row=mysqli_fetch_assoc($res);
        $user_password=$row['password'];
        
}
  else{
    ?>
    <script>
    window.location.href='user_profile.php';
    </script>
    <?php
  }
}

//update data in users table
if(isset($_POST['submit']))
  {
    
    $new_password=get_safe_data($con,$_POST['new_password']);
    $old_password=get_safe_data($con,$_POST['old_password']);
    $match="Select password from users where id=$Id";
    $match_res=mysqli_query($con,$match);
    
    $match_row=mysqli_fetch_assoc($match_res);
    if($old_password == $match_row['password'])
    {
     
      $update_sql="Update users set password='$new_password' where id='$Id' ";
      mysqli_query($con,$update_sql);  
      header("location:user_profile.php?id=$Id");        
    }
    else
    {
     $msg='Please enter the correct current password';
    
    }
   
       
 }
?>

  <div class="container">
    <div class="row"> 

      <div class="img-block col-lg-6 col-md-6">
        <img class="img-fluid rounded " src="images/login-img.jpg" alt="Login with your credentials">
      </div>

      <div class="updatepasswordform col-6">
        <h3>Forget Password</h3>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Old Password</label>
            <input type="password" name="old_password" id="login_email">
          </div>
          <div class="inpuBox">
            <label>New Password</label>
            <input type="password" name="new_password" id="login_email">
          </div>
          
          <button type="submit" name="submit" class="btn btn-outline-primary" id="updatepasswordsubmit"> Update</button><br>
          <div class="form-output">
					<p class="form-messege field_error" style="color: red;"><?php echo $msg ?></p>
				</div>
        </form>
      <a href="user_profile.php?id=<?php echo $Id ?>"> <em class="fas fa-arrow-circle-left"></em></a> 
      </div>
    
     
        
        
    </div>
     
  </div>
  <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>