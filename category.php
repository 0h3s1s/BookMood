<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<?php
$category = getCategory($db, $_GET['id']);
if (!isset($category['id'])) {
    header("Location: index.php");
};
?>

<!-- MAIN CONTENT -->
<div id="main">

    <h1 class="hover-underline">Entries of <?= $category['name'] ?>📚</h1>

    <?php
    $entries = getEntries($db, false, $_GET['id']);
    if (!empty($entries) && mysqli_num_rows($entries) >= 1):
        while ($entry = mysqli_fetch_assoc($entries)):
    ?>
            <article>
                <img src="<?= $entry['cover'] ?>" alt="book_image">
                <a href="entry.php?id=<?= $entry['id'] ?>">
                    <h2><?= $entry['title'] ?></h2>
                    <span class="date"><?= $entry['category'] . ' | ' . $entry['date'] ?></span>
                    <p><?= substr($entry['description'], 0, 300) . "..." ?></p>
                </a>
            </article>
        <?php
        endwhile;
    else:
        ?>

        <div class="alert alert-error">⛔There are no entries in this category⛔</div>
    <?php endif; ?>
</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>