<?php 
session_start();

/* This checks if the 'user' key is set in the superglobal array. 
- If it isset, it destroys the session data using the session_destroy() function. 
This is a common practice to log out a user by destroying their session data when they are already logged in. */
if (isset($_SESSION['user'])) {
    session_destroy();
}

header("Location: ../index.php");

