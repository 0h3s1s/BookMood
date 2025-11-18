<?php

require_once '../includes/connection.php';

if (isset($_POST)) {

    $category_id = intval($_POST['category']);

    //GET ALL ENTRIES AND DELETE COVER IMAGES
    $sql = "SELECT cover FROM entries WHERE category_id = $category_id";
    $result = mysqli_query($db, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        while ($entry = mysqli_fetch_assoc($result)) {

            // Obtener la ruta física
            $image_path = "../" . $entry['cover'];

            // 2. ELIMINAR FÍSICAMENTE LA IMAGEN SI EXISTE
            if (!empty($entry['cover']) && file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    // REMOVE ALL ENTRIES WHICH ARE RELATED TO THE CATEGORY
    $sql = "delete from entries where category_id=$category_id";
    mysqli_query($db, $sql);

    // REMOVE CATEGORY
    $sql = "delete from categories where id = $category_id";
    mysqli_query($db, $sql);
}
header('Location: ../edit_categories.php');
//header("Location: ../index.php");

