<?php
include_once('includes/header.php');
?>

  <div class="container-fluid">
    <div class="row"> 
      
      <div class="img-block col-lg-4 offset-1">
        <img class="img-fluid rounded " src="images/signup.jpg" alt="Login with your credentials">
      </div>

      <div class="signupform col-lg-4 offset-1">
        <h2>Sign Up</h2>
        <form action="" method="post">
          <div class="inpuBox">
            <label>Student Name</label>
            <input type="text" name="name" id="name">
            <span class="field_error" id="name_error"></span>
          </div>
          <div class="inpuBox">
            <label >Student Email</label>
            <input type="email" name="email" id="email">
            <span class="field_error" id="email_error"></span>
          </div>
          <div class="inpuBox"><button class="btn btn-outline-primary email_sent_otp" type="button" onclick="email_sent_otp()" >Send OTP</button></div>
          <div class="inpuBox"><input class="email_verify_otp" type="text" id="email_otp" placeholder="ENTER OTP">
            <button class="email_verify_otp btn btn-outline-primary" type="button" onclick="email_verify_otp()" >Verify OTP</button>
            <span class="field_error" id="email_otp_result"></span>
          </div>
                                        
							
          <div class="inpuBox">
            <label >Password</label>
            <input type="password" name="password" id="password">
            <span class="field_error" id="password_error"></span>
          </div>
          <div class="inpuBox">
            <label >Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" onchange="match_password()">
            <span class="field_error" id="confirm_password_error"></span>
          </div>
          <div class="inpuBox">
            <label >College Name</label>
            <input type="name" name="college_name" id="college_name">
            <span class="field_error" id="college_name_error"></span>
          </div>
          <div class="inpuBox">
            <label >College Id</label>
            <input type="text" name="college_id" id="college_id">
            <span class="field_error" id="college_id_error"></span>
          </div>
          <div class="inpuBox">
            <label >Year</label>
            <input type="text" name="year" id="year">
            <span class="field_error" id="year_error"></span>
          </div>
          <div class="inpuBox">
            <label >Semester</label>
            <input type="text" name="semester" id="semester">
            <span class="field_error" id="semester_error"></span>
          </div>
          <div class="inpuBox">
            <label >Stream</label>
            <input type="text" name="stream" id="stream">
            <span class="field_error" id="stream_error"></span>
          </div>
          
         
          <button type="button" class="btn btn-outline-primary" id="signup" onclick="registration()"> <em class="fas fa-user-plus"></em> Sign Up</button>
        </form>
        <div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
        <p>Already an User?<a href="login.php"> LogIn</a></p>
      </div>
    
     
        
        
    </div>
     
  </div>
 

<script>
    function email_sent_otp(){
        jQuery("#email_error").html(''); 
        var email=jQuery('#email').val();
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
                jQuery("#email").attr('disabled',true);
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
            var confirm_password=jQuery('#confirm_password').val();
            var password=jQuery('#password').val();
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