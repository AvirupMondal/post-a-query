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



    //Getting the id of user
if(isset($_GET['id']) && $_GET['id']!='')
    {
       
        $Id=get_safe_data($con,$_GET['id']);
    }

//fetching question paper
$question_paper_sqli="Select question_paper.*, users.*, stream.*,year.*,semester.*,subject.* from question_paper, users, stream, year, semester,subject where question_paper.User_Id=users.id and question_paper.Paper_Year=year.Year_Id and question_paper.Paper_Semester=semester.Semester_Id and question_paper.Paper_Stream=stream.Stream_Id and question_paper.Paper_Subject=subject.Subject_Id order by Paper_Id desc";
// echo $question_paper_sqli;

//Removing Question Paper
if(isset($_GET['type']) && $_GET['type']!='')
{
    $type=get_safe_data($con,$_GET['type']);
if($type=='delete')
            {
                $Id=get_safe_data($con,$_GET['Id']);
                $delete_sql="Delete from question_paper where Paper_Id='$Id'";
                mysqli_query($con,$delete_sql);
            }
        }



?>
<div class="main_content">
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
        <div class="col-lg-2 sidebar">
        <a href="teacher_queries.php" class="btn btn-outline-primary" 
                    style="margin-top:1rem; margin-bottom:1rem">Queries</a>
            
        </div>
        <div class=" col-lg-6 offset-1" id="getting_queries">
            <div class="mid_content">
                

                <div class="middle" id="middle">

                    <div class="info">
                        <a href="question_paper_add.php">Add Previous Year paper</a>
                    </div>
                    <div class="question">
                    <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Sl. No.</th>
                                <th scope="col">Stream</th>
                                <th scope="col">Year</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Posted On</th>
                                <th scope="col">Download</th>
                                <th scope="col"></th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                 $question_paper_res=mysqli_query($con,$question_paper_sqli);
                 $question_paper_check=mysqli_num_rows($question_paper_res);
                 $count=0;
                 while($question_paper_row=mysqli_fetch_assoc($question_paper_res)){
                    $count +=1;
                 if($question_paper_check >0)
                 {
                    
                    $question_paper_id=$question_paper_row['Paper_Id'];
                     $question_paper_name=$question_paper_row['File_Name'];
                     $question_paper_year=$question_paper_row['Year'];
                     $question_paper_sem=$question_paper_row['Semester'];
                     $question_paper_stream=$question_paper_row['Stream'];
                     $question_paper_subject=$question_paper_row['Subject'];
                     $question_paper_date=$question_paper_row['Posted_On'];
                     $question_paper_user=$question_paper_row['name'];

                 }
                 ?>
                                <tr>
                                <td ><?php echo $count?></td>
                                <td><?php echo $question_paper_stream;?></td>
                                <td><?php echo $question_paper_year;?></td>
                                <td><?php echo $question_paper_sem;?></td>
                                <td><?php echo $question_paper_subject;?></td>
                                <td><?php echo $question_paper_user;?></td>
                                <td><?php echo $question_paper_date;?></td>
                                <td><a href="<?php echo 'question_paper/'.$question_paper_row['File_Name'] ?>" download>Download</a></td>
                                <td> <?php 
                                        echo "<a href='?type=delete&Id=".$question_paper_row['Paper_Id']."'>Delete</a>";?> </td>
                                </tr>
                                
                        <?php } ?>
                            </tbody>
                            </table>
                    </div>

                    
                   
                       
                    </div>

                </div>

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
 
</body>
</html>