<?php

if (isset($_POST["submit"])) {

    // Connection to DB
    require_once '../includes/connection.php';

    // START SESSION
    if (isset($_SESSION)) {
        session_start();
    }

    // GET VALUES FROM FORM INTO VAR'S
    $name = isset($_POST['name']) ? ucfirst(mysqli_real_escape_string($db, $_POST['name'])) : false;
    $surname = isset($_POST['surname']) ? ucfirst(mysqli_real_escape_string($db, $_POST['surname'])) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    // Error array
    $errors = array();

    // VALIDATE DATA BEFORE SAVING INTO BBDD
    // NAME
    if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        echo "name is valid.";
    } else {
        $errors['name'] = $name . " is not valid";
        echo "name is wrong.";
    }

    // SURNAME
    if (!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)) {
        echo "surname is valid.";
    } else {
        $errors['surname'] = $surname . " is not valid";
        echo "surname is wrong.";
    }

    //EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // CHECK IF EMAIL EXISTS
        $sql_email = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $query_email = mysqli_query($db, $sql_email);

        if ($query_email && mysqli_num_rows($query_email) > 0) {
            // EMAIL ALREADY REGISTERED
            $errors['email'] = "This email is already registered.";
            echo "email already exists.";
        } else {
            echo "email is valid.";
        }
    } else {
        $errors['email'] = "Invalid email format.";
        echo "email is wrong.";
    }

    //PASSWORD
    if (!empty($password)) {
        echo "password is valid.";
    } else {
        $errors['password'] = $email . " is empty";
        echo "password is wrong.";
    }

    // INSERT USER INTO BBDD
    if (empty($errors)) {
        //ENCRYPT PASSWORD
        $password_safe = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        //CREATE SQL QUERY
        $sql = "insert into users values(null, 'user', '$name', '$surname', '$email', '$password_safe', curdate())";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['successful'] = "The registry was successful.";
        } else {
            $_SESSION['errors']['general'] = "Error on register the new user into the database.";
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
}
header('Location: ../index.php');
