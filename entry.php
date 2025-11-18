<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<?php
$entry = getEntry($db, $_GET['id']);
if (!isset($entry['id'])) {
    header("Location: index.php");
};
?>

<!-- MAIN CONTENT -->
<div id="main">

    <h1 class="hover-underline"><?= $entry['title'] ?>📖</h1>
    <br>
    <img style="margin: 25px auto 0 auto; width: 180px; height: 250px; display: block; box-shadow: 5px 5px;" src="<?= $entry['cover'] ?>" alt="portada" />
    <a href="category.php?id=<?= $entry['category_id'] ?>">
        <h2 class="up"><?= $entry['category'] ?>📚</h2>
    </a>
    <span><?= $entry['user'] ?> | <?= $entry['date'] ?> </span>
    <p style="text-align: justify;"><?= $entry['description'] ?></p>
    <p style="text-align: justify;"><?= $entry['content'] ?></p>

    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $entry['user_id'] || $_SESSION['user']['role'] == "admin")): ?>
        <br />
        <a style="display: inline-block; width: 15%; margin-right: 7px;" href="edit_entry.php?id=<?= $entry['id'] ?>" class="button button-secondary">Edit 📝</a>
        <a style="display: inline-block; width: 15%;" href="actions/remove-entry.php?id=<?= $entry['id'] ?>" class="button button-secondary">Remove ❌</a>
    <?php endif; ?>

</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>