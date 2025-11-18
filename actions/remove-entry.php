<?php

require_once '../includes/connection.php';

if (isset($_SESSION['user']) && isset($_GET['id'])) {
    $entry_id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];

    // GET COVER IMAGE PATH
    $sql = mysqli_query($db, "SELECT cover FROM entries WHERE id = $entry_id");
    $entry = mysqli_fetch_assoc($sql);
    $image_path = "../" . $entry['cover'];

    // DELETE ENTRY
    $sql = "delete from entries where user_id = $user_id and id=$entry_id";
    mysqli_query($db, $sql);

    // DELETE COVER IMAGE
    if (!empty($image_path) && file_exists($image_path)) {
        unlink($image_path);
    }
}

header("Location: ../index.php");
