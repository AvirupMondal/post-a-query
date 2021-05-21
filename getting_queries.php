<?php
include_once('includes/header.php');

if(!isset($_SESSION['User_Login'])){
	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}
   //Getting the id of user
if(isset($_GET['id']) && $_GET['id']!='')
    {
        $image_required='';
        $Id=get_safe_data($con,$_GET['id']);
     
    }
//Session
$id= $_SESSION['Id'];
    $name= $_SESSION['Name'];
    $college_id= $_SESSION['College_Id'];
    $college_name= $_SESSION['College_Name'];
   
//Question sql
$question='';
$post_year='';
$post_sem='';
$post_stream='';
$post_name='';
    $year= $_SESSION['Year'];
    $stream= $_SESSION['Stream'];
    $semester= $_SESSION['Semester'];
    $question_sqli="Select queries.*, users.* from queries, users where queries.Student_Id=users.id and queries.year='$year' and queries.semester='$semester' and queries.stream='$stream'";


    

    //Submit Question
if(isset($_POST['question_submit'])){

    $question=get_safe_data($con,$_POST['question']);
    $insert_question_sql="Insert into queries(Student_Id,student_name,Question,year,stream,semester) values('$id','$name','$question','$year','$stream','$semester')";
    mysqli_query($con,$insert_question_sql);
   header("location:queries.php");
}
//Submit Answer
if(isset($_POST['answer_submit']))
{
    $answer=get_safe_data($con,$_POST['answer']);
    $question_id2=$_POST['hidden_questionid'];
    $insert_answer_sql="Insert into answers(question_id,answer,answer_student_name,answer_year,answer_stream,answer_semester,student_id) values('$question_id2','$answer','$name','$year','$stream','$semester','$id')";
    mysqli_query($con,$insert_answer_sql);
    ?>
    <script type="text/javascript">
        window.location.href='queries.php?id=<?php echo $Id?>';
    </script>
    <?php
}

// Filter
$sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="container-fluid">
    <div class="row"> 
       <div class="top"> 
           <h3 class="top_left" >Welcome <?php echo $_SESSION['Name'];?></h3>
            <h4 class="top_right" ><a href="logout.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="user_profile.php?id=<?php echo $_SESSION['Id']; ?>">My Profile</a></h4>
        </div>
    </div>
</div>
<div class="container-fluid ">
    <div class="row">
        <div class="post col-lg-7 offset-3">
            
                <form action="" method="post" class="col-lg-7 offset-2">
                <input type="text" placeholder=" Write your query here" name="question" >
                <button type="submit" class="btn btn-outline-primary col-lg-3" name="question_submit">Post</button>
            </form>
        </div>
    </div> 
</div>
<!--Question and Answer-->
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-2 sidebar">
                <form>
                    <label>Select Stream</label>
                    <select id ="stream" name="stream">
                        <option value = "-1">Choose</option>
                        <?php
							foreach($data as $stream){
								?>
								<option value="<?php echo $stream['Stream_Id']?>"><?php echo $stream['Stream']?></option>
								<?php
							}
							?>
                      </select>
                      <label>Select Year</label>
                    <select id ="year" name="year">
                        <option>Select Year</option>
                        
                      </select>
                      <!-- <label>Select Semester</label>
                    <select id = "semester">
                        <option value = "1" selected>Choose</option>
                        <option value = "2">5</option>
                        <option value = "3">6</option>
                        <option value = "4">7</option>
                      </select> -->
                      <!-- <label>Select Subject</label>
                    <select id ="subject">
                        <option>Choose</option>
                      </select> -->
                      <button style="margin-top:1rem" type="button" class="btn btn-outline-primary" onclick="search()"  name="filter_submit">Search</button>
                      <div ><p id="field_error"></p></div>
                </form>
            </div>
            <div class=" col-lg-6 offset-1" id="getting_queries">
                 <?php 
                 $question_res=mysqli_query($con,$question_sqli);
                 $question_check=mysqli_num_rows($question_res);
                 while($question_row=mysqli_fetch_assoc($question_res)){
                    
                 if($question_check >0)
                 {
                    $question_id=$question_row['Query_Id'];
                     $question=$question_row['Question'];
                     $post_year=$question_row['year'];
                     $post_sem=$question_row['semester'];
                     $post_stream=$question_row['stream'];
                     $post_name=$question_row['name'];

                 }
                 ?>
                 
          <div class="middle" >
            
              <div class="info">
                <em class="fas fa-user-circle"></em>
                  <h5><?php echo $post_name;?></h5>
                  <p><?php echo $post_stream .$post_year .$post_sem;?></p>
              </div>
                <div class="question">
                    <h6>Question</h6>
                        <p><?php echo $question;?></p>
                </div>
              
                <div class="reply">
                    <form action="" method="post" class="col-lg-7">
                        <input type="text" placeholder=" Write your Answer here" name="answer" >
                        <input type="hidden" name="hidden_questionid" value="<?php echo  $question_id ?>">
                        <button type="submit" class="btn btn-outline-primary col-lg-3" name="answer_submit">Post</button>
                    </form>
                </div>

                <?php 
                 //Answer Sql              
                 $answer='';
                 $answer_year='';
                 $answer_sem='';
                 $answer_stream='';
                 $answer_name='';
                 $answer_sqli="Select * from  answers where question_id='$question_id'";
                 $answer_res=mysqli_query($con,$answer_sqli);
                 $answer_check=mysqli_num_rows($answer_res);
                
                 ?>
                <div class="answer">
                    <h6>Answer</h6>
                    <?php 
                    while($answer_row=mysqli_fetch_assoc($answer_res)){
                    
                    if($answer_check >0)
                    {
                        $answer=$answer_row['answer'];
                        $answer_year=$answer_row['answer_year'];
                        $answer_sem=$answer_row['answer_semester'];
                        $answer_stream=$answer_row['answer_stream'];
                        $answer_name=$answer_row['answer_student_name'];
                    }?>
                    <div class="answerdisplay">
                        <em class="fas fa-user-circle"></em>
                       
                        <div class="answers">
                            <h6><?php echo $answer_name;?></h6>
                            <h6><?php echo $answer_stream .$answer_year .$answer_sem;?></h6>
                            <p><?php echo $answer;?></p>
                        </div>
                    </div><?php } ?>
                </div>
                
           </div>
                
            <?php } ?> </div>
          </div>
      </div>
      

      <?php 
 include_once('includes/footer.php');
 ?>
 <script>
	jQuery(document).ready(function(){
		jQuery('#stream').change(function(){
			var id=jQuery(this).val();
            //alert(id);
			if(id=='-1'){
				jQuery('#year').html('<option value="-1">Select Year</option>');
			}else{
				
				jQuery('#year').html('<option value="-1">Select Year</option>');
				jQuery('#subject').html('<option value="-1">Select Subject</option>');
				jQuery.ajax({
					type:'post',
					url:'get_year.php',
					data:'id='+id+'&type=year',
					success:function(result){
					console.log(result);
						jQuery('#year').append(result);
					}
				});
			}
		});
		// jQuery('#year').change(function(){
		// 	var id=jQuery(this).val();
        //     var stream=jQuery('#stream').val();
		// 	if(id=='-1'){
		// 		jQuery('#subject').html('<option value="-1">Select Subject</option>');
		// 	}else{
			
		// 		jQuery('#subject').html('<option value="-1">Select Subject</option>');
		// 		jQuery.ajax({
		// 			type:'post',
		// 			url:'get_subject.php',
		// 			data:'id='+id+ '&stream='+stream+'&type=subject',
		// 			success:function(result){
		// 			//alert(result);
        //                 jQuery('#subject').append(result);
		// 			}
		// 		});
		// 	}
		// });
	});

function search(){
    var stream = jQuery(#stream).val();
    var year = jQuery(#year).val();
    var field_error='';
    if(stream=='-1'){
        jQuery('#field_error').html("Select your Stream");
        field_error='yes';
    }
    if(year=='-1'){
        jQuery('#field_error').html("Select your Year");
        field_error='yes';
    }
    if(field_error==''){
        jQuery.ajax({
					type:'post',
					url:'get_queries.php',
					data:'stream='+stream+'&year='+year,
					success:function(result){
                        window.location.href='getting_queries.php?stream='+stream+'&year='+year;
					}
				});
    }
}
	</script>
</body>
</html>