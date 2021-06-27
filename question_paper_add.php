<?php
include_once('includes/header.php');

if(!isset($_SESSION['User_Login'])){
	?>
<script>
    window.location.href = 'login.php';
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

$sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
//Upload Question Paper
if(isset($_POST['submit']))
 {
    
    // $question_paper_name=get_safe_data($con,$_POST['edit_File_Name']);
    $question_paper_year=get_safe_data($con,$_POST['year']);
    $question_paper_sem=get_safe_data($con,$_POST['semester']);
    $question_paper_stream=get_safe_data($con,$_POST['stream']);
    $question_paper_subject=get_safe_data($con,$_POST['subject']);
    $file=$_FILES['editfile']['name'];
    move_uploaded_file($_FILES['editfile']['tmp_name'],'question_paper/'.$file);
    //Submit Answer

    $date=date('Y-m-d');
    $insert_answer_sql="Insert into question_paper(Paper_Stream,Paper_Year,Paper_Semester,Paper_Subject,File_Name,Posted_On,User_Id) values('$question_paper_stream','$question_paper_year','$question_paper_sem','$question_paper_subject','$file','$date','$id')";
    // echo $insert_answer_sql;
    
    mysqli_query($con,$insert_answer_sql);
    ?>
    <script type="text/javascript">
        window.location.href='upload_previous_year_question.php';
    </script>
    <?php

       
 }
?>
    <div class="main_content">
        <div class="container-fluid">
            <div class="row">
                <div class="top">
                    <h3 class="top_left">Welcome
                        <?php echo $_SESSION['Name'];?>
                    </h3>
                    <h4 class="top_right"><a href="logout.php">Log Out</a></h4>
                    <h4 class="top_right"><a href="teacher_profile.php?id=<?php echo $_SESSION['Id']; ?>">My Profile</a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 sidebar">
                </div>
                <div class=" col-lg-6 offset-1" id="getting_queries">
                    <div class="mid_content">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Select Stream</label>
                                <select id="stream" name="stream"  onchange="FetchYear(this.value)" required>
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
                            </div>
                            <div class="form-group">
                                <label>Select Year</label>
                                <select id="year" name="year" onchange="FetchSemester(this.value)" required>
                                    <option>Select Year</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Semester</label>
                                <select id="semester" name="semester" onchange="FetchSubject(this.value)" required>
                                    <option value="1" selected>Select Semester</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Subject</label>
                                <select id="subject" name="subject">
                                    <option>Select Subject</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Select File</label>
                                <input type="file" name="editfile" id="editfile">
                            </div>
                            <button style="margin-top:1rem" type="submit" class="btn btn-outline-primary"
                                name="submit">Add the Question Paper</button>



                        </form>
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
                function FetchYear(id) {
                    $('#year').html('');
                    $('#semester').html('<option>Select Semester</option>');
                    $('#subject').html('<option>Select Subject</option>');
                    $.ajax({
                        type: 'post',
                        url: 'filter.php',
                        data: { stream_id: id },
                        success: function (data) {
                            $('#year').html(data);
                        }

                    })
                }

                function FetchSemester(id) {
                    $('#semester').html('');
                    $('#subject').html('<option>Select Subject</option>');
                    $.ajax({
                        type: 'post',
                        url: 'filter.php',
                        data: { year_id: id },
                        success: function (data) {
                            $('#semester').html(data);
                        }

                    })
                }

                function FetchSubject(id) {
                    $('#subject').html('');
                    $.ajax({
                        type: 'post',
                        url: 'filter.php',
                        data: { semester_id: id },
                        success: function (data) {
                            $('#subject').html(data);
                        }

                    })
                }
            </script>
    </body>

</html>