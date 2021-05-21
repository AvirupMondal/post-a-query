<?php 
require('includes/db.php');
require('includes/function.php');
$name=get_safe_data($con,$_POST['name']);
$email=get_safe_data($con,$_POST['email']);
$college_name=get_safe_data($con,$_POST['college_name']);
$college_id=get_safe_data($con,$_POST['college_id']);
$year=get_safe_data($con,$_POST['year']);
$semester=get_safe_data($con,$_POST['semester']);
$stream=get_safe_data($con,$_POST['stream']);
$password=get_safe_data($con,$_POST['password']);


$check_sql="Select * from users where email='$email'";
$res=mysqli_query($con,$check_sql);
$check=mysqli_num_rows($res);
if($check>0){
    echo "email_present";
}
else{
  
      
      $insert_sql="Insert into users(name,email,password,year,semester,stream,college_name,college_id,student) values('$name','$email','$password','$year','$semester','$stream','$college_name','$college_id','1')";
      mysqli_query($con,$insert_sql);
    
  
  echo "email_insert";  
}



?>