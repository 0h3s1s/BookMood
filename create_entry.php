<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div id="main">
    <h1 class="hover-underline">Entries📕</h1>
    <p>
        Add new entry to the website, so that users are able to read and enjoy the content.
    </p>
    <br />
    <form action="actions/save-entry.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" required />
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'title') : '' ?>

        <br />
        <label style="display: inline-block; width: 12%;" for="cover">Cover Image</label>
        <input type="file" name="cover" accept="image/png, image/jpg, image/jpeg" />
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'cover') : '' ?>

        <br /><br />
        <label for="description">Description</label>
        <textarea name="description" rows="3" cols="111" required></textarea>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'description') : '' ?>

        <br /><br />
        <label style="display: inline-block; width: 8%;" for="category">Category</label>
        <select style="display: inline-block;" name="category">
            <?php
            $categories = getCategories($db);
            if (!empty($categories)):
                while ($category = mysqli_fetch_assoc($categories)):
            ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'category') : '' ?>

        <br /><br />
        <label for="content">Content</label>
        <textarea name="content" rows="30" cols="111" required></textarea>
        <?php echo isset($_SESSION['entry-errors']) ? showErrors($_SESSION['entry-errors'], 'content') : '' ?>

        <br /><br />
        <input class="button button-secondary" type="submit" value="Save ✔" />
    </form>
    <?php removeErrors(); ?>
</div>

<?php require_once 'includes/footer.php'; ?>