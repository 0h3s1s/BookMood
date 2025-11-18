<?php require_once 'includes/redirect.php'; ?>
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
    <h1 class="hover-underline">Edit Entry</h1>
    <p>
        Edit entry <?= $entry['title'] ?>, so that users are able to read and enjoy the updated content.
    </p>
    <br />
    <form action="actions/save-entry.php?edit=<?= $entry['id'] ?>" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?= $entry['title'] ?>" />
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'title') : '' ?>

        <br />
        <label for="description">Description</label>
        <textarea name="description" rows="3" cols="111" required><?= $entry['description'] ?></textarea>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'description') : '' ?>

        <br /><br />
        <label style="display: inline-block; width: 8%;" for="category">Category</label>
        <select style="display: inline-block;" name="category">
            <?php $categories = getCategories($db);
            if (!empty($categories)):
                while ($category = mysqli_fetch_assoc($categories)):
            ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $entry['category_id']) ? "selected='selected'" : '' ?>><?= $category['name'] ?></option>
            <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'category') : '' ?>

        <br /><br />
        <label for="content">Content</label>
        <textarea name="content" rows="30" cols="111" required><?= $entry['content'] ?></textarea>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'content') : '' ?>

        <br /><br />
        <input class="button button-secondary" type="submit" value="Save ✔" />
    </form>
    <?php removeErrors(); ?>
</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>