<?php 
require('includes/db.php');
require('includes/function.php');
$name=get_safe_data($con,$_POST['name']);
$email=get_safe_data($con,$_POST['email']);
$password=get_safe_data($con,$_POST['password']);


$check_sql="Select * from users where email='$email'";
$res=mysqli_query($con,$check_sql);
$check=mysqli_num_rows($res);
if($check>0){
    echo "email_present";
}
else{
  
      
      $insert_sql="Insert into users(name,email,password,teacher) values('$name','$email','$password','1')";
      mysqli_query($con,$insert_sql);
    
  
  echo "email_insert";  
}



?>