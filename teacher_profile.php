<?php
include_once('includes/header.php');
if(!isset($_SESSION['User_Login'])){
	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}
$college=$_SESSION['College_Name'];
$department=$_SESSION['Stream'];
if(isset($_GET['id']) && $_GET['id']!='')
{
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
                    header("location:teacher_profile.php?id=$Id");
                }
        }
}

    $sqli="Select users.*,college_list.*,stream.* from users,college_list,stream where users.id='$Id' and college_list.id='$college' and users.stream=stream.Stream_Id and stream.Stream_Id='$department'";
    $res=mysqli_query($con,$sqli);
   
        $row=mysqli_fetch_assoc($res);
        $student_name=$row['name'];
        $student_email=$row['email'];
        $student_image=$row['image'];
        $student_college=$row['College_Name'];
        $student_department=$row['Stream'];

?>

<div class="container-fluid">
    <div class="row"> 
       <div class="top"> 
            <h4 class="top_right" ><a href="login.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="teacher_queries.php?id=<?php echo $Id ?>">Home</a></h4>
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
                    <input type="file" name="editimage" class="form-control" style="margin-top: 1rem; border: 1px #0275dB solid; margin-bottom:1rem" required>
                    <button type="submit" name="submit" class="btn btn-outline-primary" >Change Profile Picture</button>
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
                            <td><?php echo  $student_college;?></td>
                        </tr>
                        <tr>
                            <th scope="col">Department: </th>
                            <td><?php echo  $student_department;?></td>
                        </tr>           
                        
                    </tbody>
                    </table>
                </div>
                <div class="user-buttons">
                    <a class="btn btn-outline-primary" href="teacher_change_password.php?id=<?php echo $_SESSION['Id']; ?>"> Change Password</a>
                    <a class="btn btn-outline-success" href="teacher_edit_profile.php?id=<?php echo $_SESSION['Id']; ?>">Edit Profile</a>
                    
                </div>
            </div>
            
          </div>
      </div>
   

 <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>