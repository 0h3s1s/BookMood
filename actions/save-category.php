<?php

if (isset($_POST)) {
    // Connection to DB
    require_once '../includes/connection.php';

    // START SESSION
    if (isset($_SESSION)) {
        session_start();
    }

    $name = isset($_POST['name']) ? strtoupper(mysqli_real_escape_string($db, $_POST['name'])) : false;

    // Error array
    $errors = array();

    // VALIDATE DATA BEFORE SAVING INTO BBDD
    // NAME
    if (empty($name)) {
        $errors['name'] = $name . " is not valid";
    }
    
    if (count($errors) == 0) {
        $sql = "insert into categories values(null, '$name')";
        $save = mysqli_query($db, $sql);
    }
}
header('Location: ../edit_categories.php');
//header('Location: ../index.php');

