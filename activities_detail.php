<?php
include_once('includes/header.php');
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $Id=get_safe_data($con,$_GET['id']);
  }
  $student_name=$_SESSION['Name'];
  $student_id=$_SESSION['Id'];
  $question='';
  $post_year='';
  $post_sem='';
  $post_stream='';
  $post_name='';
  $question_sqli="Select * from queries where Query_Id='$Id'";
  $question_res=mysqli_query($con,$question_sqli);
  $question_check=mysqli_num_rows($question_res);
 
?>

<div class="container-fluid main_content">
    <div class="row  "> 
       <div class="top"> 
           <h3 class="top_left" >Welcome <?php echo $student_name ?></h3>
            <h4 class="top_right" ><a href="login.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="user_profile.php?id=<?php echo $student_id ?>">My Profile</a></h4>
            <h4 class="top_right" ><a href="user_activities.php?id=<?php echo $student_id ?>"><i class="fas fa-arrow-circle-left"></i></a></h4>
        </div>
    </div>


<!--Question and Answer-->
      
      <div class="container">  
          <div class="row ">
            <?php
          while($question_row=mysqli_fetch_assoc($question_res)){
     
     if($question_check >0)
     {
        $question_id=$question_row['Query_Id'];
         $question=$question_row['Question'];
         $post_year=$question_row['year'];
         $post_sem=$question_row['semester'];
         $post_stream=$question_row['stream'];
         $post_name=$question_row['student_name'];
   
     } ?>

              <div class="middle col-lg-7 offset-lg-2 mid_content ">
              <div class="info">
                <em class="fas fa-user-circle"></em>
                  <h5>Sl No. <?php echo $question_id ?></h5>
                  
              </div>
                <div class="question">
                    <h6>Question</h6>
                    <p><?php echo $question ?></p>
                </div>
                
                <?php 
                 $answer='';
                 $answer_year='';
                 $answer_sem='';
                 $answer_stream='';
                 $answer_name='';
                 $answer_sqli="Select * from  answers where question_id='$Id'";
                 $answer_res=mysqli_query($con,$answer_sqli);
                 $answer_check=mysqli_num_rows($answer_res);
                
                 ?>
                <div class="answer">
                    <h6>Answer</h6>

                    <?php  while($answer_row=mysqli_fetch_assoc($answer_res)){
                    
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
                    </div>
                    <?php } ?>
                    

                </div>
            </div>
            <?php } ?>
          </div>
          </div>  
      </div>
   

      <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>