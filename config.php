<?php



//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('570272692010-s0f95a66l2s64bob3q6ktmp3bfnhpe3g.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('ReCQQBrI1n_34ZUwa9_cBIka');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/post_a_query/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 