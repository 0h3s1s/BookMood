<?php require_once 'includes/connection.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>BookMood</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">BookMood☕</a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li><a href="index.php">☕</a></li>
                <?php
                $categories = getCategories($db);
                if (!empty($categories)):
                    while ($category = mysqli_fetch_assoc($categories)):
                ?>
                        <li><a href="category.php?id=<?= $category['id'] ?>"><?= $category['name']; ?>📚</a></li>
                <?php
                    endwhile;
                endif;
                ?>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>