<?php 
require('includes/db.php');
require('includes/function.php');

$email=get_safe_data($con,$_POST['email']);
$password=get_safe_data($con,$_POST['password']);

$check_sql="Select * from users where email='$email' and password='$password'";
$res=mysqli_query($con,$check_sql);
$check=mysqli_num_rows($res);
if($check>0){
    $row=mysqli_fetch_assoc($res);
    $_SESSION['User_Login']='yes';
   

    $_SESSION['Id']=$row['id'];
    $_SESSION['Name']=$row['name'];
    $_SESSION['College_Id']=$row['college_id'];
    $_SESSION['College_Name']=$row['college_name'];
    $_SESSION['Year']=$row['year'];
    $_SESSION['Stream']=$row['stream'];
    $_SESSION['Semester']=$row['semester'];
    $_SESSION['Email']=$row['email'];
    $_SESSION['Student']=$row['student'];
    $_SESSION['Teacher']=$row['teacher'];
    $_SESSION['Password']=$row['password'];
    if($_SESSION['Student']=='1'){
        $result='1';
    }else{
        $result='2';
    }
    echo $result;
}
else{
    $result='wrong';
    echo $result;  
}

?>