<?php
include('includes/db.php');
$type=$_POST['type'];
$id=$_POST['id'];
if($type=='like'){
	$sql="update answers set likes=likes+1 where answer_id=$id";
}else{
	$sql="update answers set dislikes=dislikes+1 where answer_id=$id";
}
$res=mysqli_query($con,$sql);
?>