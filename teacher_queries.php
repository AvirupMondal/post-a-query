<?php
include_once('includes/header.php');

if(!isset($_SESSION['User_Login'])){
	?>
	<script>
	window.location.href='login.php';
	</script>
	<?php
}
//Session
$id= $_SESSION['Id'];
    $name= $_SESSION['Name'];
    $stream= $_SESSION['Stream'];
    
//Question sql
    $question='';
    $post_year='';
    $post_sem='';
    $post_stream='';
    $post_name='';
    //Filter Submit
if(isset($_GET['filter_submit'])){
    $year= get_safe_data($con,$_GET['year']);
    $stream=get_safe_data($con,$_GET['stream']);
    $semester= get_safe_data($con,$_GET['semester']);
    $subject=get_safe_data($con,$_GET['subject']);
    $question_sqli="Select queries.*, stream.*,year.*,semester.*,subject.*, users.* from queries, stream, year, semester, subject, users where queries.Student_Id=users.id and queries.year='$year' and queries.semester='$semester' and queries.stream='$stream' and queries.subject='$subject' and year.Year_Id='$year' and semester.Semester_Id='$semester' and stream.Stream_Id='$stream' and subject.Subject_Id='$subject'";
    // echo $question_sqli;
  
}

else{
   
    $question_sqli="Select queries.*, users.*, stream.*,year.*,semester.* from queries, users, stream, year, semester where queries.Student_Id=users.id and queries.year=year.Year_Id and queries.semester=semester.Semester_Id and queries.stream=stream.Stream_Id and queries.stream='$stream' order by Query_Id desc";
    //  echo $question_sqli;
 
}


    //Getting the id of user
if(isset($_GET['id']) && $_GET['id']!='')
    {
       
        $Id=get_safe_data($con,$_GET['id']);
    }


//Submit Answer
if(isset($_POST['answer_submit']))
{
    $answer=get_safe_data($con,$_POST['answer']);
    $question_id2=$_POST['hidden_questionid'];
    $date=date('Y-m-d');
    $insert_answer_sql="Insert into answers(question_id,answer,answer_student_name,answer_year,answer_semester,answer_stream,Posted_On,student_id,likes,dislikes) values('$question_id2','$answer','$name','17','4','$stream','$date','$id','0','0')";
    mysqli_query($con,$insert_answer_sql);
    ?>
    <script type="text/javascript">
        window.location.href='teacher_queries.php?id=<?php echo $Id?>';
    </script>
    <?php
}
//Like Dislikes


// Filtering
$sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div class="main_content">
<div class="container">
    <div class="row"> 
       <div class="top"> 
           <h3 class="top_left" >Welcome <?php echo $_SESSION['Name'];?></h3>
            <h4 class="top_right" ><a href="logout.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="teacher_profile.php?id=<?php echo $_SESSION['Id']; ?>">My Profile</a></h4>
        </div>
    </div>
</div>
<!--Question and Answer-->
<div class="container">
    <div class="row">
        <div class="col-lg-3 sidebar">
            <form method="get" action="">
                <label>Select Stream</label>
                <select id="stream" name="stream" onchange="FetchYear(this.value)"  required>
                    <option value="">Choose</option>
                    <?php
							foreach($data as $stream){
								?>
                    <option value="<?php echo $stream['Stream_Id']?>">
                        <?php echo $stream['Stream']?>
                    </option>
                    <?php
							}
							?>
                </select>
                <label>Select Year</label>
                <select id="year" name="year"  onchange="FetchSemester(this.value)"  required>
                    <option value="">Select Year</option>

                </select>
                <label>Select Semester</label>
                <select id="semester" name="semester" onchange="FetchSubject(this.value)"  required>
                    <option value="" selected>Select Semester</option>

                </select>
                <label>Select Subject</label>
                <select id="subject" name="subject">
                    <option value="">Select Subject</option>
                </select>

                <button style="margin-top:1rem" type="submit"  class="btn btn-outline-primary" 
                    name="filter_submit">Filter the Questions</button>
                <a href="teacher_queries.php" class="btn btn-outline-primary" 
                    style="margin-top:1rem">See All Questions</a>
                <div>
                    <p id="field_error"></p>
                </div>

                
            </form>
            

            <a href="upload_previous_year_question.php"  class="btn btn-outline-primary" style="margin-bottom:1rem">Upload Previous Year Questions</a>
        </div>
        <div class=" col-lg-7 offset-lg-1" id="getting_queries">
            <div class="mid_content">
                <?php 
                 $question_res=mysqli_query($con,$question_sqli);
                 $question_check=mysqli_num_rows($question_res);
                 while($question_row=mysqli_fetch_assoc($question_res)){
                    
                 if($question_check >0)
                 {
                    $question_id=$question_row['Query_Id'];
                     $question=$question_row['Question'];
                     $post_year=$question_row['Year'];
                     $post_sem=$question_row['Semester'];
                     $post_stream=$question_row['Stream'];
                     $post_name=$question_row['name'];
                     $post_date=$question_row['Posted_On'];

                 }
                 ?>

                <div class="middle" id="middle">

                    <div class="info">
                        <em class="fas fa-user-circle"></em>
                        <h5 style="color:blue">
                            <?php echo $post_name;?>
                        </h5>
                        <p style="color:red">
                            <?php echo $post_stream .','.' '.$post_year.'th Year,'.' '.$post_sem.'th Sem,';?>
                        </p>
                        <p style="color:red">
                            Posted On <?php echo $post_date ;?>
                        </p>
                    </div>
                    <div class="question">
                        <h6>Question</h6>
                        <p>
                            <?php echo $question;?>
                        </p>
                    </div>

                    <div class="reply">
                        <form action="" method="post" class="col-lg-7">
                            <input type="text" placeholder=" Write your Answer here" name="answer" required>
                            <input type="hidden" name="hidden_questionid" value="<?php echo  $question_id ?>">
                            <button type="submit" class="btn btn-outline-primary col-lg-3"
                                name="answer_submit">Post</button>
                        </form>
                    </div>

                    <?php 
                 //Answer Sql              
                 $answer='';
                 $answer_year='';
                 $answer_sem='';
                 $answer_stream='';
                 $answer_name='';
                 $answer_sqli="Select answers.*, stream.*, year.*, semester.* from  answers,year,semester,stream where answers.question_id='$question_id' and answers.answer_year=year.Year_Id and answers.answer_stream=stream.Stream_Id and answers.answer_semester=semester.Semester_Id";
                //  echo $answer_sqli;
                 $answer_res=mysqli_query($con,$answer_sqli);
                 $answer_check=mysqli_num_rows($answer_res);
                
                 ?>
                    <div class="answer">
                        <h6>Answer</h6>
                        <?php 
                    while($answer_row=mysqli_fetch_assoc($answer_res)){
                    
                    if($answer_check >0)
                    {
                        $answer_id=$answer_row['answer_id'];
                        $answer=$answer_row['answer'];
                        $answer_year=$answer_row['Year'];
                        $answer_sem=$answer_row['Semester'];
                        $answer_stream=$answer_row['Stream'];
                        $answer_name=$answer_row['answer_student_name'];
                        $answer_post_date=$answer_row['Posted_On'];
                        $answer_likes=$answer_row['likes'];
                        $answer_dislikes=$answer_row['dislikes'];
                        
                        
                    }
                    
                                
                    
                    ?>
                        <div class="answerdisplay">
                            <em class="fas fa-user-circle"></em>

                            <div class="answers">
                                <h6 style="color:red">
                                    <?php echo $answer_name;?>
                                </h6>

                                <h6 style="color:blue">
                                    <?php echo $answer_stream .','.' '.$answer_year.'th Year,'.' '.$answer_sem.'th Sem,';?>
                                </h6>
                                <p>
                                   Posted On <?php echo $answer_post_date;?>
                                </p>
                                <p>
                                    <?php echo $answer;?>
                                </p>
                               
                                <a href="javascript:void(0)" class="btn btn-outline-success"  style="margin-bottom:0.3rem">
						        <span class="far fa-grin" onclick="like_update('<?php echo $answer_id?>')"> Support The Answer (<span id="like_loop_<?php echo $answer_id?>"><?php echo $answer_likes?></span>)</span>
					            </a>
                                <a href="javascript:void(0)" class="btn btn-warning"  style="margin-bottom:0.3rem">
						<span class="far fa-frown-open" onclick="dislike_update('<?php echo $answer_id?>')"> Don't Support The Answer (<span id="dislike_loop_<?php echo $answer_id?>"><?php echo $answer_dislikes?></span>)</span>
					</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                </div>

                <?php } ?>
            </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    <?php 
    include_once('includes/inner_footer.php');
 include_once('includes/footer.php');
  ?>
    <script type="text/javascript">
  function FetchYear(id){
    $('#year').html('');
    $('#semester').html('<option>Select Semester</option>');
    $('#subject').html('<option>Select Subject</option>');
    $.ajax({
      type:'post',
      url: 'filter.php',
      data : { stream_id : id},
      success : function(data){
         $('#year').html(data);
      }

    })
  }

  function FetchSemester(id){ 
    $('#semester').html('');
    $('#subject').html('<option>Select Subject</option>');
    $.ajax({
      type:'post',
      url: 'filter.php',
      data : { year_id : id},
      success : function(data){
         $('#semester').html(data);
      }

    })
  }

  function FetchSubject(id){ 
    $('#subject').html('');
    $.ajax({
      type:'post',
      url: 'filter.php',
      data : { semester_id : id},
      success : function(data){
         $('#subject').html(data);
      }

    })
  }
  function like_update(id){
			jQuery.ajax({
				url:'like_dislike_update.php',
				type:'post',
				data:'type=like&id='+id,
				success:function(result){
					var cur_count=jQuery('#like_loop_'+id).html();
					cur_count++;
					jQuery('#like_loop_'+id).html(cur_count);
			
				}
			});
		}	
		
		function dislike_update(id){
			jQuery.ajax({
				url:'like_dislike_update.php',
				type:'post',
				data:'type=dislike&id='+id,
				success:function(result){
					var cur_count=jQuery('#dislike_loop_'+id).html();
					cur_count++;
					jQuery('#dislike_loop_'+id).html(cur_count);
			
				}
			});
		}
  
  
</script>
</body>
</html>