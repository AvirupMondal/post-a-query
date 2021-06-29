<?php
include_once('includes/header.php');
//fetch data from table

if(isset($_GET['id']) && $_GET['id']!=''){
  $Id=get_safe_data($con,$_GET['id']);
  $sqli="Select * from users where users.id='$Id'";
  $res=mysqli_query($con,$sqli);
  $check=mysqli_num_rows($res);
  if($check >0){
    $row=mysqli_fetch_assoc($res);
        $teacher_names=$row['name'];
        $teacher_emails=$row['email'];
}
  else{
    ?>
    <script>
    window.location.href='teacher_profile.php';
    </script>
    <?php
  }
}

//update data in users table
if(isset($_POST['submit']))
 {
    $teacher_name=get_safe_data($con,$_POST['edit_name']);
    $teacher_email=get_safe_data($con,$_POST['edit_email']);
    
    
  
        if(isset($_GET['id']) && $_GET['id']!='')
        {
         
          $update_sql="Update users set name='$teacher_name',email='$teacher_email' where id='$Id' ";
          mysqli_query($con,$update_sql);  
          header("location:teacher_profile.php?id=$Id");
            
        }
        else
        {
          
           header("location:teacher_profile.php?id=$Id");
        }
   
       
 }
?>
  <div class="container">
    <div class="row"> 
      
      <div class="img-block col-lg-6 col-md-6">
        <img class="img-fluid rounded " src="images/editprofile.jpg" alt="Login with your credentials">
      </div>

      <div class="editform col-lg-6 col-md-6">
        <h2>Edit Profile</h2>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Teacher Name</label>
            <input type="text" name="edit_name" id="login_email" value="<?php echo $teacher_names;?>" required>
          </div>
          <div class="inpuBox">
            <label >Teacher Email</label>
            <input type="email" name="edit_email" id="login_password" value="<?php echo $teacher_emails;?>" required>
          </div>
          <button type="submit" class="btn btn-outline-primary" id="update_user_profile" name="submit">Update</button>
        </form>
        <div class="user-buttons">
                   
          <a class="btn btn-outline-primary" href="teacher_profile.php?id=<?php echo $Id?>" style="margin-bottom: 1rem; text-align: center;
          margin-left: auto;">My Profile</a>
         
      </div>
      </div>
    
     
        
        
    </div>
     
  </div>
  <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>