<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div id="main">
    <h1 class="hover-underline">My Data🙂</h1>
    <p>
        Update your account's name, surname or email as you wish!
    </p>

    <br>
    <form action="actions/update-user.php" method="POST">

        <!-- INPUT Name -->
        <label for="name">Name</label>
        <input type="text" name="name" value="<?= $_SESSION['user']['name'] ?>" required/>  
        <?php echo isset($_SESSION['errors']) ? showErrors($errors, $name) : ''; ?>

        <!-- INPUT Surname -->
        <label for="surname">Surname</label>
        <input type="text" name="surname" value="<?= $_SESSION['user']['surname'] ?>" required/>
        <?php echo isset($_SESSION['errors']) ? showErrors($errors, $surname) : ''; ?>

        <!-- INPUT Email -->
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['user']['email'] ?>" required/>
        <?php echo isset($_SESSION['errors']) ? showErrors($errors, $email) : ''; ?>

        <!-- INPUT SUBMIT -->
        <input class="button button-secondary" type="submit" name="submit" value="Save ✔"/>
    </form>
    <?php if (isset($_SESSION['successful'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['successful']; ?>
        </div>
    <?php elseif (isset($_SESSION['errors']['general'])): ?>
        <div class="alert alert-error">
            <?= $_SESSION['errors']['general']; ?>
        </div>        
    <?php endif; ?>
    <?php removeErrors(); ?>
</div>

<?php require_once 'includes/footer.php'; ?>
 

