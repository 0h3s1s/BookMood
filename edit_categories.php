<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div id="main">
    <h1 class="hover-underline">Categories📚</h1>
    <p>
        Add or remove categories to the website, so that users are able to use it's entries.
    </p>
    <form action="actions/save-category.php" method="POST">
        <br>
        <label style="display: inline-block; width: 15%; padding: 8px; font-size: 16px;" for="name">Create category:</label>
        <input style="display: inline-block; width: 35%;" type="text" name="name" placeholder="Insert a name for the new category" autofocus required/>
        <input style="display: inline-block;" class="button button-secondary" type="submit" value="Save ✔"/>
    </form>

    <form action="actions/remove-category.php" method="POST">
        <label style="display: inline-block; width: 17%;" for="category">Remove category:</label>
        <select name="category">
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

        <input style="display: inline-block;" class="button button-secondary" type="submit" value="Remove ❌"/>
    </form>

</div>

<?php require_once 'includes/footer.php'; ?>
 