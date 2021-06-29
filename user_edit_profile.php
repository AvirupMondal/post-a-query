<?php
include_once('includes/header.php');
//fetch data from table

if(isset($_GET['id']) && $_GET['id']!=''){
  $image_required='';
  $Id=get_safe_data($con,$_GET['id']);
  
  $sqli="Select users.*, stream.*,year.*,semester.*,college_list.* from users, stream, year, semester,college_list where users.id='$Id' and users.year=year.Year_Id and users.semester=semester.Semester_Id and users.stream=stream.Stream_Id and users.college_name=college_list.id ";
//  echo $sqli;
  $res=mysqli_query($con,$sqli);
  $check=mysqli_num_rows($res);
  if($check >0){
    $row=mysqli_fetch_assoc($res);
        $student_names=$row['name'];
        $student_college_ids=$row['college_id'];
        $student_college_names=$row['College_Name'];
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

 $sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
//Fetching College Name

$college_sql="select * from college_list";
$college_result = mysqli_query($con,$college_sql);
$college_data = mysqli_fetch_all($college_result, MYSQLI_ASSOC);
?>
  <div class="container">
    <div class="row"> 
      
      <div class="img-block col-lg-6 col-md-6">
        <img class="img-fluid rounded " src="images/editprofile.jpg" alt="Login with your credentials">
      </div>

      <div class="editform col-lg-6 col-md-6 ">
        <h2>Edit Profile</h2>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Student Name</label>
            <input type="text" name="edit_name" id="login_email" value="<?php echo $student_names;?>" required>
          </div>
          <div class="inpuBox">
            <label >Student Email</label>
            <input type="email" name="edit_email" id="login_password" value="<?php echo $student_emails;?>" required>
          </div>
         
          <div class="inpuBox">
            <label >Select College</label>
            <select id="college" name="edit_college_name" required>
                    <option value="">Select College</option>
                    <?php
							foreach($college_data as $college){
                
								?>
                    <option value="<?php echo $college['id']?>" >
                        <?php echo $college['College_Name']?>
                    </option>
                    <?php
							}
							?>
                </select>
            <span class="field_error" id="college_error"></span>
          </div>
          <div class="inpuBox">
            <label >College Id</label>
            <input type="text" name="edit_college_id" id="college_id" value="<?php echo $student_college_ids?>" required>
            <span class="field_error" id="college_id_error"></span>
          </div>
          <div class="inpuBox">
          <label>Select Stream</label>
                <select id="stream" name="edit_stream" onchange="FetchYear(this.value)"  required>
                    <option value="">Choose</option>
                    <?php
							foreach($data as $stream){
               
								?>
                    <option value="<?php echo $stream['Stream_Id']?>" >
                        <?php echo $stream['Stream']?>
                    </option>
                    <?php
							}
							?>
                </select> </div>
                <div class="inpuBox">
                <label>Select Year</label>
                <select id="year" name="edit_year"  onchange="FetchSemester(this.value)"  required>
                    <option value="">Select Year</option>

                </select> </div>
                <div class="inpuBox">
                <label>Select Semester</label>
                <select id="semester" name="edit_semester" onchange="FetchSubject(this.value)"  required>
                    <option value="" selected>Select Semester</option>

                </select>
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
 <script>

function FetchYear(id){
    $('#year').html('');
    $('#semester').html('<option>Select Semester</option>');
    
    $.ajax({
      type:'post',
      url: 'filter.php',
      data : { stream_id : id},
      success : function(data){
         $('#year').html(data);
      }

    })
  }

  function FetchSemester(id){ 
    $('#semester').html('');
    
    $.ajax({
      type:'post',
      url: 'filter.php',
      data : { year_id : id},
      success : function(data){
         $('#semester').html(data);
      }

    })
  }
 </script>
</body>
</html>