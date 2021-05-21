<?php
include_once('includes/header.php');

if(isset($_GET['id']) && $_GET['id']!=''){
  $image_required='';
  $Id=get_safe_data($con,$_GET['id']);
}
$question='';
$question_id='';
$question_sqli="Select * from queries where Student_Id='$Id'";
$question_res=mysqli_query($con,$question_sqli);
$question_check=mysqli_num_rows($question_res);

?>

<div class="container-fluid">
    <div class="row"> 
       <div class="top"> 
            <h4 class="top_right" ><a href="login.php">Log Out</a></h4>
            <h4 class="top_right" ><a href="userprofile.php">Home</a></h4>
        </div>
    </div>
</div>

<!--Question and Answer-->
      <div class="container-fluid">
          <div class="row">
            <div class="user-activities-block">
                <div class="user-img">
                    <img class="img-fluid" src="images/ID5907@2x.png" alt="" >
                   
                </div>
                <div class="user-activities-info col-lg-10">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <th scope="col" class="col-lg-1">Sl.No. </th>
                            <th scope="col" >Question Posted</th>
                            
                            <th scope="col" class="col-lg-1"></th>
                            
                        </tr>
                    <?php
                        while($question_row=mysqli_fetch_assoc($question_res)){
                        if($question_check >0)
                            {
                                $question_id=$question_row['Query_Id'];
                                $question=$question_row['Question'];
                                
                                
                            
                            }
                    ?>
                        <tr>
                            <td><?php echo $question_id ?></td>
                            <td><p><?php echo $question ?></p>
                            <td><a href="activities_detail.php?id=<?php echo $question_id ?>" class="btn btn-outline-primary">Visit</a></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    </table>
                </div>
                <div class="user-buttons">
                   
                    <a class="btn btn-outline-primary" href="user_profile.php?id=<?php echo $Id?>">My Profile</a>
                   
                </div>
            </div>
            
          </div>
      </div>
   
      <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>