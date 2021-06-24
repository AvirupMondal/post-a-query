<?php 
include_once('includes/db.php');
include_once('includes/function.php');

if (isset($_POST['stream_id'])) {
	$query = "SELECT * FROM year where Stream_Id=".$_POST['stream_id'];
	// echo $query;
	// die();
	$result = mysqli_query($con,$query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$stream_check=mysqli_num_rows($result);
	// $result = $db->query($query);
	if ($stream_check > 0 ) {
			echo '<option value="">Select Year</option>';
			foreach($data as $year){
		 	echo '<option value='.$year['Year_Id'].'>'.$year['Year'].'</option>';
		 }
	}else{

		echo '<option>No Year Found!</option>';
	}

}elseif (isset($_POST['year_id'])) {
	 

	$query = "SELECT * FROM semester where Year_Id=".$_POST['year_id'];
	$result = mysqli_query($con,$query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$year_check=mysqli_num_rows($result);
	// $result = $db->query($query);
	if ($year_check > 0 ) {
			echo '<option value="">Select Semester</option>';
			foreach($data as $semester){
		 	echo '<option value='.$semester['Semester_Id'].'>'.$semester['Semester'].'</option>';
		 }
	}else{

		echo '<option>No Semester Found!</option>';
	}

}
elseif (isset($_POST['semester_id'])) {
	 

	$query = "SELECT * FROM subject where Semester_Id=".$_POST['semester_id'];
	$result = mysqli_query($con,$query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$semester_check=mysqli_num_rows($result);
	// $result = $db->query($query);
	if ($semester_check > 0 ) {
			echo '<option value="">Select Subject</option>';
			foreach($data as $subject){
		 	echo '<option value='.$subject['Subject_Id'].'>'.$subject['Subject'].'</option>';
		 }
	}else{

		echo '<option>No Subject Found!</option>';
	}

}

?>