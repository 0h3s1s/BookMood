<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<?php
if (!isset($_POST['search'])) {
    header("Location: index.php");
};
?>

<!-- MAIN CONTENT -->
<div id="main">

    <h1 class="hover-underline">Search of '<?= $_POST['search'] ?>' 🔍</h1>

    <?php
    $entries = getEntries($db, null, null, $_POST['search']);
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
        <div class="alert alert-error">There are no entries in this category.</div>
    <?php endif; ?>
</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>