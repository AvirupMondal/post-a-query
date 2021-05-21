<?php 
require('includes/db.php');
require('includes/function.php');
$password=get_safe_data($con,$_POST['password']);
$confirm_password=get_safe_data($con,$_POST['confirm_password']);
if($password==$confirm_password){
    echo 'matched';
}
else{
    echo 'not matched';
}

?>