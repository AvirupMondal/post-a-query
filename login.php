<?php
include_once('includes/header.php');


//index.php

//Include Configuration File
// include('config.php');

// $login_button = '';


// if(isset($_GET["code"]))
// {

//  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


//  if(!isset($token['error']))
//  {
 
//   $google_client->setAccessToken($token['access_token']);

 
//   $_SESSION['access_token'] = $token['access_token'];


//   $google_service = new Google_Service_Oauth2($google_client);

 
//   $data = $google_service->userinfo->get();

 
//   if(!empty($data['given_name']))
//   {
//    $_SESSION['user_first_name'] = $data['given_name'];
//   }

//   if(!empty($data['family_name']))
//   {
//    $_SESSION['user_last_name'] = $data['family_name'];
//   }

//   if(!empty($data['email']))
//   {
//    $_SESSION['user_email_address'] = $data['email'];
//   }

//   if(!empty($data['gender']))
//   {
//    $_SESSION['user_gender'] = $data['gender'];
//   }

//   if(!empty($data['picture']))
//   {
//    $_SESSION['user_image'] = $data['picture'];
//   }
//  }
// }


// if(!isset($_SESSION['access_token']))
// {

//  $login_button = '<a href="'.$google_client->createAuthUrl().'" id="google">Google</a>';
// }
?>
<div class="container-fluid">
  <div class="row login_mid"> 
    <div class="img-block col-lg-4 offset-2">
      <img class="img-fluid rounded " src="images/bg1-01.png" alt="Login with your credentials">
    </div>

    <div class="loginform col-lg-4 offset-1">
      <h2>LogIn</h2>
      <form id="Login_form" method="post">

        <div class="inpuBox">
          <label>Email</label>
          <input type="email" name="user_email" id="login_email" required><br>
          <span class="field_error" id="email_error"></span>
        </div>
        

        <div class="inpuBox form-group">
          <label >Password</label>
          <input type="password" name="user_password" id="login_password" required><br>
          <span class="field_error" id="password_error"></span>
        </div>
        

        <div class="forget_password"><p><a href="forgetpassword.php">Forget Password?</a></p></div>
        <div>
          <button type="button" onclick="login_submit()" class="btn login-btn col-lg-6" value="Login" > LOGIN</button>
        </div>
        <div class="form-output login_msg">
					<p class="form-messege field_error"></p>
				</div>
        </form>
       <!-- <hr>
      <form action="" method="post">
        <button type="submit" class="btn btn-outline-primary col-lg-8" id="google"><em class="fab fa-google-plus-g"></em> <?php echo $login_button;?></button>
        <button type="submit" class="btn btn-outline-primary col-lg-8" id="linkedln"><em class="fab fa-linkedin"></em> Continue with Linkedin</button>
      </form> -->
      <p>Not an User?<a href="signupwelcome.php"> SignUp</a></p>
    </div>
  </div>
</div>

  <?php 
 include_once('includes/footer.php');
 ?>

    
</body>
</html>