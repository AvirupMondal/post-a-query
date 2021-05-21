<?php 
require('includes/db.php');
include('config.php');
   
   unset ($_SESSION['USER_LOGIN']);
   unset  ($_SESSION['Id']);
   unset  ($_SESSION['Name']);
   unset  ($_SESSION['College_Id']);
   unset  ($_SESSION['College_Name']);
   unset  ($_SESSION['Year']);
   unset  ($_SESSION['Stream']);
   unset  ($_SESSION['Semester']);
   unset  ($_SESSION['Email']);
   unset  ($_SESSION['Student']);
   unset ($_SESSION['Teacher']);
  
//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to login.php
header('location:login.php');

die();

?>