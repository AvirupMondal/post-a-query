<?php
include_once('includes/db.php');
$id=$_POST['id'];
$type=$_POST['type'];

if($type=='year'){
	$sql="select * from year where Stream_Id='$id' ";
	$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$html='';
foreach($data as $list){
	$html.='<option value='.$list['Year_Id'].'>'.$list['Year'].'</option>';
}
}else{
	$html.='<option value="-1">Select Stream</option>';
}

echo $html;

?>