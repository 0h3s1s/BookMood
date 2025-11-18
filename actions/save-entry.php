<?php

if (isset($_POST)) {
    // Connection to DB
    require_once '../includes/connection.php';

    // START SESSION
    if (isset($_SESSION)) {
        session_start();
    }

    $user = $_SESSION['user']['id'];
    $category = isset($_POST['category']) ? (int) $_POST['category'] : false;
    $title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
    $content = isset($_POST['content']) ? mysqli_real_escape_string($db, $_POST['content']) : false;

    // Error array
    $errors = array();

    // VALIDATE DATA BEFORE SAVING INTO BBDD
    // NAME
    if (empty($title)) {
        $errors['title'] = "Title is not valid";
    }

    // DESCRIPTION
    if (empty($description)) {
        $errors['description'] = "Description is not valid";
    }

    // CONTENT
    if (empty($description)) {
        $errors['content'] = "Content is not valid";
    }

    // CATEGORY
    if (empty($category) && !is_numeric($category)) {
        $errors['description'] = "Category is not valid";
    }

    if (count($errors) == 0) {
        if (isset($_GET['edit'])) {
            $entry_id = $_GET['edit'];
            $user_id = $_SESSION['user']['id'];
            $sql = "update entries set title='$title', description='$description', content='$content',  category_id=$category " .
                "where id=$entry_id";
        } else {
            if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
                $cover_path = null;

                // INFORMACIÓN DEL ARCHIVO
                $fileTmp  = $_FILES['cover']['tmp_name'];
                $fileName = $_FILES['cover']['name'];
                $fileType = $_FILES['cover']['type'];

                // EXTENSIÓN
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                // NOMBRE ÚNICO PARA GUARDAR
                $newFileName = uniqid('cover_') . '.' . $extension;

                // DIRECTORIO DESTINO
                $uploadDir = '../assets/img/';
                $destination = $uploadDir . $newFileName;

                // FILE
                if (move_uploaded_file($fileTmp, $destination)) {
                    // SAVE FINAL PATH TO DB
                    $uploadDir = 'assets/img/';
                    $destination = $uploadDir . $newFileName;
                    $cover_path = $destination;

                    $sql = "insert into entries values(null, $user, $category, '$title', '$description', '$content', '$cover_path', curdate())";
                }
            }
        }
        $save = mysqli_query($db, $sql);
        header('Location: ../index.php');
    } else {
        $_SESSION['entry-errors'] = $errors;
        if (isset($_GET['edit'])) {
            header("Location: ../edit-entry.php?id=" . $_GET['edit']);
        } else {
            header('Location: ../create_entry.php');
        }
    }
}
