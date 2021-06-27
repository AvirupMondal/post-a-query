<?php
include_once('includes/header.php');
$sql="select * from stream";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

//Fetching College Name

$college_sql="select * from college_list";
$college_result = mysqli_query($con,$college_sql);
$college_data = mysqli_fetch_all($college_result, MYSQLI_ASSOC);
?>
  <div class="container-fluid">
    <div class="row"> 
      
      <div class="img-block col-lg-4 offset-2">
        <img class="img-fluid rounded " src="images/signup.jpg" alt="Login with your credentials">
      </div>

      <div class="signupform col-lg-4 offset-1">
        <h2>Sign Up</h2>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Teacher Name</label>
            <input type="text" name="teacher_name" id="teacher_name"><br>
            <span class="field_error" id="name_error"></span>
          </div>
          
          <div class="inpuBox">
            <label >Teacher Email</label>
            <input type="email" name="teacher_email" id="teacher_email"><br>
            <span class="field_error" id="email_error"></span>
          </div>
          <div class="inpuBox"><button class="btn btn-outline-primary email_sent_otp" type="button" onclick="email_sent_otp()" >Send OTP</button></div>
          <div class="inpuBox"><input class="email_verify_otp" type="text" id="email_otp" placeholder="ENTER OTP">
            <button class="email_verify_otp btn btn-outline-primary" type="button" onclick="email_verify_otp()" >Verify OTP</button>
            <span class="field_error" id="email_otp_result"></span>
          </div>
          <div class="inpuBox">
            <label >Password</label>
            <input type="password" name="teacher_password" id="teacher_password"><br>
            <span class="field_error" id="password_error"></span>
          </div>
          <div class="inpuBox">
            <label >Confirm Password</label>
            <input type="password" name="teacher_confirm_password" id="teacher_confirm_password" onchange="match_password()"><br>
            <span class="field_error" id="confirm_password_error"></span>
          </div>
          <div class="inpuBox">
            <label >Select College</label>
            <select id="college" name="college" required>
                    <option value="-1">Select College</option>
                    <?php
							foreach($college_data as $college){
								?>
                    <option value="<?php echo $college['id']?>">
                        <?php echo $college['College_Name']?>
                    </option>
                    <?php
							}
							?>
                </select>
            <span class="field_error" id="college_error"></span>
          </div>
          <div class="inpuBox">
            <label >Select Department</label>
            <select id="stream" name="stream" required>
                    <option value="-1">Select Department</option>
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
            <span class="field_error" id="department_error"></span>
          </div>
         
          <button type="button" class="btn btn-outline-primary" id="signup" onclick="teacher_registration()"> <em class="fas fa-user-plus"></em> Sign Up</button>
        </form>
        <div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
       <!-- <hr>
        <form action="" method="post">
          <button type="submit" class="btn btn-outline-primary col-lg-8" id="google"><em class="fab fa-google-plus-g"></em> Continue with Google</button>
          <button type="submit" class="btn btn-outline-primary col-lg-8" id="linkedin"><em class="fab fa-linkedin"></em> Continue with Linkedin</button>
        </form> -->
        <p>Already an User?<a href="login.php"> LogIn</a></p>
      </div>
    
     
        
        
    </div>
     
  </div>
  
<script>
    function email_sent_otp(){
        jQuery("#email_error").html(''); 
        var email=jQuery('#teacher_email').val();
        if(email==''){
            jQuery("#email_error").html('Please Enter a Email Id');           
        }
        else{
            jQuery(".email_sent_otp").html('Please Wait..');     
            jQuery(".email_sent_otp").attr('disabled',true);
            jQuery.ajax({
                url:'send_otp.php',
                type:'post',
                data:'email='+email+'&type=email',
                success:function(result){
            if(result=='done'){
                jQuery("#teacher_email").attr('disabled',true);
                jQuery(".email_verify_otp").show();
                jQuery(".email_sent_otp").hide();
                        }
            else{
                jQuery(".email_sent_otp").html('Send Otp');     
                jQuery(".email_sent_otp").attr('disabled',false);
                jQuery("#email_error").html('Please Try After Sometime');  
                }
            }
                
        });
   
    }
}
    function email_verify_otp(){
  jQuery("#email_error").html(''); 
            var email_otp=jQuery('#email_otp').val();
        if(email_otp==''){
            jQuery("#email_error").html('Please Enter valid OTP'); 
        }
        else{jQuery.ajax({
                url:'check_otp.php',
                type:'post',
                data:'otp='+email_otp+'&type=email',
                success:function(result){
                    if(result=='done'){
       jQuery(".email_verify_otp").hide();
        jQuery("#email_otp_result").html("Email Sucessfully Verify");
                    }
                    else{
                        jQuery("#email_error").html('Please Enter a Valid OTP');  
                    }
                }
                
            });
   
        
        }
    }

    function match_password(){
  jQuery("#confirm_password_error").html(''); 
            var confirm_password=jQuery('#teacher_confirm_password').val();
            var password=jQuery('#teacher_password').val();
            if(password==''){
            jQuery("#password_error").html('Please Enter your password '); 
        }
        if(confirm_password==''){
            jQuery("#confirm_password_error").html('Please Confirm your password '); 
        }
        else{
          jQuery.ajax({
                url:'confirm_password.php',
                type:'post',
                data:'confirm_password='+confirm_password+ '&password='+password,
                success:function(result){
                    if(result=='matched'){
       
        jQuery("#confirm_password_error").html("Password Matched");
                    }
                    else{
                        jQuery("#confirm_password_error").html('Please Check your password');  
                    }
                }
                
            });
   
        
        }
    }


</script>
  <?php 
 include_once('includes/footer.php');
 ?>
</body>
</html>