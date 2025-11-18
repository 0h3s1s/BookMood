<?php
require_once '../includes/connection.php';

if (isset($_GET['id'])) {
  $user_id = intval($_GET['id']);

  $sql = "delete from entries where user_id=$user_id";
  mysqli_query($db, $sql);

  $sql = "delete from users where id=$user_id";
  mysqli_query($db, $sql);
}

// VOLVER A LA LISTA
header("Location: ../remove_users.php");
exit;
?>