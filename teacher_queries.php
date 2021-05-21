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
    $name= $_SESSION['Name'];
    
//Question sql
    $question='';
    $post_year='';
    $post_sem='';
    $post_stream='';
    $post_name='';
    $question_sqli="Select queries.*, users.* from queries, users where queries.Student_Id=users.id ";


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
    $insert_answer_sql="Insert into answers(question_id,answer,answer_student_name) values('$question_id2','$answer','$name')";
    mysqli_query($con,$insert_answer_sql);
    ?>
    <script type="text/javascript">
        window.location.href='teacher_queries.php?id=<?php echo $Id?>';
    </script>
    <?php
}

?>

<div class="container-fluid">
    <div class="row"> 
       <div class="top"> 
           <h3 class="top_left" >Welcome <?php echo $_SESSION['Name'];?></h3>
            <h4 class="top_right" ><a href="logout.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="teacher_profile.php?id=<?php echo $_SESSION['Id']; ?>">My Profile</a></h4>
        </div>
    </div>
</div>

<!--Question and Answer-->
      <div class="container-fluid">
          <div class="row">
            <!-- <div class="col-lg-2 sidebar">
                <form>
                    <label>Select Stream</label>
                    <select id = "stream">
                        <option value = "1" selected>Choose</option>
                        <option value = "2">ECE</option>
                        <option value = "3">CSE</option>
                        <option value = "4">EE</option>
                      </select>
                      <label>Select Year</label>
                    <select id = "year">
                        <option value = "1" selected>Choose</option>
                        <option value = "2">2</option>
                        <option value = "3">3</option>
                        <option value = "4">4</option>
                      </select>
                      <label>Select Semester</label>
                    <select id = "semester">
                        <option value = "1" selected>Choose</option>
                        <option value = "2">5</option>
                        <option value = "3">6</option>
                        <option value = "4">7</option>
                      </select>
                      <label>Select Subject</label>
                    <select id = "subject">
                        <option value = "1" selected>Choose</option>
                        <option value = "2">DBMS</option>
                        <option value = "3">VLSI</option>
                        <option value = "4">RF & Microwave</option>
                      </select>
                </form>
            </div> -->

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
            <div class="middle col-lg-6 offset-3">
            
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
            <?php } ?>
          </div>
      </div>
   

      <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>