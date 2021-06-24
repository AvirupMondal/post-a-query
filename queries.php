<?php
include_once('includes/header.php');

if(!isset($_SESSION['User_Login'])){
	?>
<script>
    window.location.href = 'login.php';
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
    $year= $_SESSION['Year'];
    $stream= $_SESSION['Stream'];
    $semester= $_SESSION['Semester'];
    $question_sqli="Select queries.*, users.*, stream.*,year.*,semester.* from queries, users, stream, year, semester where queries.Student_Id=users.id and queries.year='$year' and queries.semester='$semester' and queries.stream='$stream' and year.Year_Id='$year' and semester.Semester_Id='$semester' and stream.Stream_Id='$stream' order by Query_Id desc";
    //  echo $question_sqli;
 
}
if(isset($_POST['search_question'])){
    $year= $_SESSION['Year'];
    $stream= $_SESSION['Stream'];
    $semester= $_SESSION['Semester'];
    $str=mysqli_real_escape_string($con,$_POST['search']);
    $question_sqli="Select queries.*, users.*, stream.*,year.*,semester.* from queries, users, stream, year, semester where queries.Student_Id=users.id and queries.year='$year' and queries.semester='$semester' and queries.stream='$stream' and year.Year_Id='$year' and semester.Semester_Id='$semester' and stream.Stream_Id='$stream' and queries.Question LIKE '%$str%'";
    // echo $question_sqli;
}

    //Submit Question
if(isset($_POST['question_submit'])){

    $question=get_safe_data($con,$_POST['question']);
    $date=date('Y-m-d');
    $insert_question_sql="Insert into queries(Student_Id,student_name,Question,year,stream,semester,Posted_On) values('$id','$name','$question','$year','$stream','$semester','$date')";
    mysqli_query($con,$insert_question_sql);
   header("location:queries.php");
}
//Submit Answer
if(isset($_POST['answer_submit']))
{
    $answer=get_safe_data($con,$_POST['answer']);
    $date=date('Y-m-d');
    $question_id2=$_POST['hidden_questionid'];
    $insert_answer_sql="Insert into answers(question_id,answer,answer_student_name,answer_year,answer_stream,answer_semester,student_id,Posted_On) values('$question_id2','$answer','$name','$year','$stream','$semester','$id','$date)";
    mysqli_query($con,$insert_answer_sql);
    ?>
<script type="text/javascript">
    window.location.href = 'queries.php?id=<?php echo $Id?>';
</script>
<?php
}

// Filtering
$sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<div class="main_content">
<div class="container-fluid">
    <div class="row">
        <div class="top">
            <h3 class="top_left">Welcome
                <?php echo $_SESSION['Name'];?>
            </h3>
            <h4 class="top_right"><a href="logout.php">Log Out</a></h4>
            <h4 class="top_right"><a href="user_profile.php?id=<?php echo $_SESSION['Id']; ?>">My Profile</a></h4>
        </div>
    </div>
</div>
<div class="container-fluid ">
    <div class="row">
        <div class="post col-lg-7 offset-3">

            <form action="" method="post" class="col-lg-7 offset-2">
                <input type="text" placeholder=" Write your query here" name="question">
                <button type="submit" class="btn btn-outline-primary col-lg-3" name="question_submit">Post</button>
            </form>
        </div>
    </div>
</div>
<!--Question and Answer-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 sidebar">
            <form method="get" action="">
                <label>Select Stream</label>
                <select id="stream" name="stream" onchange="FetchYear(this.value)"  required>
                    <option value="-1">Choose</option>
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
                    <option>Select Year</option>

                </select>
                <label>Select Semester</label>
                <select id="semester" name="semester" onchange="FetchSubject(this.value)"  required>
                    <option value="1" selected>Select Semester</option>

                </select>
                <label>Select Subject</label>
                <select id="subject" name="subject">
                    <option>Select Subject</option>
                </select>

                <button style="margin-top:1rem" type="submit"  class="btn btn-outline-primary" 
                    name="filter_submit">Filter the Questions</button>
                <a href="queries.php" class="btn btn-outline-primary" 
                    style="margin-top:1rem">See All Questions</a>
                <div>
                    <p id="field_error"></p>
                </div>

                
            </form>
            <form action="" method="post">
                <input type="text" placeholder=" Write your question here" name="search">
                <button type="submit" class="btn btn-outline-primary" name="search_question">Search Question</button>
            </form>
        </div>
        <div class=" col-lg-6 offset-1" id="getting_queries">
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
                            <input type="text" placeholder=" Write your Answer here" name="answer">
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
                 $answer_sqli="Select answers.*, stream.*, year.*, semester.* from  answers,year,semester,stream where question_id='$question_id' and year.Year_Id=answers.answer_year and semester.Semester_Id=answers.answer_semester and stream.Stream_Id=answers.answer_stream";
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
                        $answer_year=$answer_row['Year'];
                        $answer_sem=$answer_row['Semester'];
                        $answer_stream=$answer_row['Stream'];
                        $answer_name=$answer_row['answer_student_name'];
                        $answer_post_date=$answer_row['Posted_On'];
                    }?>
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
    <?php 
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

  
  
</script>
    </body>

    </html>