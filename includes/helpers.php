<?php

function showErrors($errors, $field) {
    $alert = '';
    if (isset($errors[$field]) && !empty($field)) {
        $alert = "<div class='alert alert-error'>" . $errors[$field] . '</div>';
    }

    return $alert;
}

function removeErrors() {
    $deleted = false;

    if (isset($_SESSION['errors'])) {
        $_SESSION['errors'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['entry-errors'])) {
        $_SESSION['entry-errors'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['successful'])) {
        $_SESSION['successful'] = null;
        $deleted = true;
    }

    return $deleted;
}

function getCategories($db) {
    $sql = "select * from categories order by name asc";
    $categories = mysqli_query($db, $sql);

    if ($categories && mysqli_num_rows($categories) >= 1) {
        return $categories;
    } else {
        return null;
    }
}

function getCategory($db, $id) {
    $sql = "select * from categories where id = $id";
    $categories = mysqli_query($db, $sql);

    if ($categories && mysqli_num_rows($categories) >= 1) {
        return mysqli_fetch_assoc($categories);
    } else {
        return null;
    }
}

function getEntries($db, $limit = null, $category = null, $searched = null, $user = null) {
    $sql = "select e.*, c.name as 'category' from entries e " .
            "inner join categories c on e.category_id = c.id ";
    if (!empty($category)) {
        $sql .= "where e.category_id = $category ";
    }

    if (!empty($searched)) {
        $sql .= "where e.title like '%$searched%' ";
    }

    if (!empty($user)) {
        $user = (int)$user;
        $sql .= "where e.user_id = $user ";
    }

    $sql .= "order by e.id desc ";

    if ($limit) {
        $sql .= "limit 4";
    }

    $entries = mysqli_query($db, $sql);

    if ($entries && mysqli_num_rows($entries) >= 1) {
        return $entries;
    } else {
        return null;
    }
}

function getEntry($db, $id) {
    $sql = "select e.*, c.name as 'category', concat(u.name, ' ', u.surname) as user from entries e " .
            "inner join categories c on e.category_id = c.id " .
            "inner join users u on e.user_id = u.id " .
            "where e.id = $id";
    $entries = mysqli_query($db, $sql);

    if ($entries && mysqli_num_rows($entries) >= 1) {
        return mysqli_fetch_assoc($entries);
    } else {
        return null;
    }
}
