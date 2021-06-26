<?php
include('includes/db.php');
$type=$_POST['type'];
$id=$_POST['id'];
if($type=='like'){
	$sql="update like_dislike set likes=likes+1 where id=$id";
}else{
	$sql="update like_dislike set dislikes=dislikes+1 where id=$id";
}
$res=mysqli_query($con,$sql);
?>