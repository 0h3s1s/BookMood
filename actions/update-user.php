<?php

if (isset($_POST["submit"])) {

    // Connection to DB
    require_once '../includes/connection.php';

    // GET VALUES FROM FORM INTO VAR'S
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $surname = isset($_POST['surname']) ? mysqli_real_escape_string($db, $_POST['surname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

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
        echo "email is valid.";
    } else {
        $errors['email'] = $email . " is not valid";
        echo "email is wrong.";
    }

    // UPDATE USER INTO BBDD
    if (empty($errors)) {
        $user = $_SESSION['user'];

        // CHECK IF ANY EMAIL EXISTS
        $sql = "select id, email from users where email='$email'";
        $query_email = mysqli_query($db, $sql);
        $query_user = mysqli_fetch_assoc($query_email);

        if ($query_user['id'] == $user['id'] || empty($query_user)) {
            //CREATE SQL QUERY
            $sql = "update users set name='$name', surname = '$surname', email = '$email' where id = " . $user['id'];
            $query = mysqli_query($db, $sql);

            if ($query) {
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['surname'] = $surname;
                $_SESSION['user']['email'] = $email;
                $_SESSION['successful'] = "The update was successful.";
            } else {
                $_SESSION['errors']['general'] = "Error on update the user into the database.";
            }
        } else {
            $_SESSION['errors']['general'] = "Email already exists in the database.";
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
}
header('Location: ../modify_mydata.php');
