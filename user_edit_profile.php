<?php
include_once('includes/header.php');
//fetch data from table

if(isset($_GET['id']) && $_GET['id']!=''){
  $image_required='';
  $Id=get_safe_data($con,$_GET['id']);
  
  $sqli="Select users.*, stream.*,year.*,semester.* from users, stream, year, semester where users.id='$Id' and users.year=year.Year_Id and users.semester=semester.Semester_Id and users.stream=stream.Stream_Id ";
 $res=mysqli_query($con,$sqli);
  $check=mysqli_num_rows($res);
  if($check >0){
    $row=mysqli_fetch_assoc($res);
        $student_names=$row['name'];
        $student_college_ids=$row['college_id'];
        $student_college_names=$row['college_name'];
        $student_semesters=$row['Semester'];
        $student_years=$row['Year'];
        $student_streams=$row['Stream'];
        $student_emails=$row['email'];
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
    $student_name=get_safe_data($con,$_POST['edit_name']);
    $student_college_id=get_safe_data($con,$_POST['edit_college_id']);
    $student_college_name=get_safe_data($con,$_POST['edit_college_name']);
    $student_semester=get_safe_data($con,$_POST['edit_semester']);
    $student_year=get_safe_data($con,$_POST['edit_year']);
    $student_stream=get_safe_data($con,$_POST['edit_stream']);
    $student_email=get_safe_data($con,$_POST['edit_email']);
    
  
        if(isset($_GET['id']) && $_GET['id']!='')
        {
         
          $update_sql="Update users set name='$student_name',college_id='$student_college_id',college_name='$student_college_name',semester='$student_semester',year='$student_year',stream='$student_stream',email='$student_email' where id='$Id' ";
          mysqli_query($con,$update_sql);  
          header("location:user_profile.php?id=$Id");
            
        }
        else
        {
          
           header("location:user_profile.php?id=$Id");
        }
   
       
 }
?>
  <div class="container-fluid">
    <div class="row"> 
      
      <div class="img-block col-lg-4 offset-2">
        <img class="img-fluid rounded " src="images/editprofile.jpg" alt="Login with your credentials">
      </div>

      <div class="editform col-lg-4 offset-1">
        <h2>Edit Profile</h2>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Student Name</label>
            <input type="text" name="edit_name" id="login_email" value="<?php echo $student_names;?>">
          </div>
          <div class="inpuBox">
            <label >Student Email</label>
            <input type="email" name="edit_email" id="login_password" value="<?php echo $student_emails;?>">
          </div>
          
          <div class="inpuBox">
            <label >College Name</label>
            <input type="name" name="edit_college_name" id="login_password" value="<?php echo $student_college_names;?>">
          </div>
          <div class="inpuBox">
            <label >College Id</label>
            <input type="text" name="edit_college_id" id="login_password" value="<?php echo $student_college_ids;?>">
          </div>
          <div class="inpuBox">
            <label >Year</label>
            <input type="text" name="edit_year" id="login_password" value="<?php echo $student_years;?>">
          </div>
          <div class="inpuBox">
            <label >Semester</label>
            <input type="text" name="edit_semester" id="login_password" value="<?php echo $student_semesters;?>">
          </div>
          <div class="inpuBox">
            <label >Stream</label>
            <input type="text" name="edit_stream" id="login_password" value="<?php echo $student_streams;?>">
          </div>
          
         
          <button type="submit" class="btn btn-outline-primary" id="update_user_profile" name="submit">Update</button>
        </form>
        <div class="user-buttons">
                   
          <a class="btn btn-outline-primary" href="user_profile.php?id=<?php echo $Id?>" style="margin-bottom: 1rem; text-align: center;
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