<?php

/* This PHP code snippet is handling a form submission for user login. Here's a breakdown of what each
part is doing: */

// START SESSION && BBDD CONNECTION
require_once '../includes/connection.php';
session_start();

// GET DATA FROM FORM
if (isset($_POST)) {

    /* The code is checking if the session variable `error_login` is set. If it is set, it then unsets (removes)
that session variable. */
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }

    // GET DATA FROM FORM
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // CHECK USER INSERTED CREDENTIALS   
    /* This is a SQL query to retrieve user data from a database table based on the provided email address.*/
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    /* Checks the user input credentials against the data retrieved from the database.*/
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // CHECK PASSWORD
        /* This is verifying the password entered by the user during the login process.*/
        if (password_verify($password, $user['password'])) {
            // USE A SESSION TO SAVE LOGGED USER
            $_SESSION['user'] = $user;
        } else {
            // IF FAILS, SENDS SESSION WITH ERROR
            $_SESSION['error_login'] = "Wrong password.";
        }
    } else {
        // USER NOT FOUND
        $_SESSION['error_login'] = "User not found.";
    }

    // REDIRECT
    header("Location: ../index.php");
    exit();
}
