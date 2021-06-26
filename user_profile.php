<?php
include_once('includes/header.php');
if(!isset($_SESSION['User_Login'])){
	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}
if(isset($_GET['id']) && $_GET['id']!='')
{
    $image_required='';
    $Id=get_safe_data($con,$_GET['id']);
}
if(isset($_POST['submit']))
{
    if(isset($_GET['id']) && $_GET['id']!='')
        {
            if($_FILES['editimage']['name']!='')
                {
                    $image=rand(111111111,999999999).'_'.$_FILES['editimage']['name'];
                    move_uploaded_file($_FILES['editimage']['tmp_name'],'./user_image/'.$image);
                    $update_sql="Update users set image='$image' where id='$Id' ";
                    mysqli_query($con,$update_sql);  
                    header("location:user_profile.php?id=$Id");
                }
        }
}

    $sqli="Select users.*, stream.*,year.*,semester.* from users, stream, year, semester where users.id='$Id' and users.year=year.Year_Id and users.semester=semester.Semester_Id and users.stream=stream.Stream_Id ";
    // echo $sqli;
    // die();
    $res=mysqli_query($con,$sqli);
   
        $row=mysqli_fetch_assoc($res);
        $student_name=$row['name'];
        $student_college_id=$row['college_id'];
        $student_college_name=$row['college_name'];
        $student_semester=$row['Semester'];
        $student_year=$row['Year'];
        $student_stream=$row['Stream'];
        $student_email=$row['email'];
        $student_image=$row['image'];

?>

<div class="container-fluid">
    <div class="row"> 
       <div class="top"> 
            <h4 class="top_right" ><a href="login.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="queries.php?id=<?php echo $Id ?>">Home</a></h4>
        </div>
    </div>
</div>

<!--Question and Answer-->
      <div class="container-fluid">
          <div class="row">
            <div class="user-block">
                <div class="user-img">
                    <img class="img-fluid" src="user_image/<?php echo $student_image ?>" alt="this is my image" >
                    <form method="post" enctype="multipart/form-data">
                    <input type="file" name="editimage" class="form-control" style="margin-top: 1rem; border: 1px #0275dB solid; margin-bottom:1rem" >
                    <button type="submit" name="submit" class="btn btn-outline-primary" >Click To Update Pic</button>
                    </form>
                </div>
                <div class="user-info col-lg-4">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th scope="col">Name: </th>
                            <td><?php echo $student_name;?></td>
                        </tr>
                        <tr>
                            <th scope="col">Email: </th>
                            <td><?php echo  $student_email;?></td>
                        </tr>
                        <tr>
                            <th scope="col">College: </th>
                            <td><?php echo  $student_college_name;?></td>
                        </tr>
                        <tr>
                            <th scope="col">College Id: </th>
                            <td><?php echo  $student_college_id;?></td>
                        </tr>
                        <tr>
                            <th scope="col">Stream: </th>
                            <td><?php echo  $student_stream;?></td>
                        </tr>
                        <tr>
                            <th scope="col">Year: </th>
                            <td><?php echo  $student_year;?></td>
                        </tr>
                        <tr>
                            <th scope="col">Semester: </th>
                            <td><?php echo  $student_semester;?></td>
                        </tr>                
                        
                    </tbody>
                    </table>
                </div>
                <div class="user-buttons">
                    <a class="btn btn-outline-primary" href="change_password.php?id=<?php echo $_SESSION['Id']; ?>"> Change Password</a>
                    <a class="btn btn-outline-success" href="user_edit_profile.php?id=<?php echo $_SESSION['Id']; ?>">Edit Profile</a>
                    <a class="btn btn-outline-danger" href="user_activities.php?id=<?php echo $Id ?>">Your Activities</a>
                </div>
            </div>
            
          </div>
      </div>
   

 <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>