<div id="container">
    <!-- SIDE BAR -->
    <aside id="sidebar">

        <!--SEARCHER-->
        <div id="login" class="sidebar-block">
            <h3>Search</h3>
            <form action="search.php" method="POST">
                <input style="display: inline-block; width: 80%;" type="text" name="search" required />
                <input style="display: inline-block; height: auto; margin: 0;" class="button button-primary" type="submit" name="submit" value="🔍" />
            </form>
        </div>

        <?php 
            // PREVENT WARNINGS
            $user = $_SESSION['user'] ?? null;
            $role = $user['role'] ?? null;
        ?>

        <?php if ($user): ?>
            <div id="user-loggedin" class="sidebar-block">
                <h3>Welcome, <?= htmlspecialchars($user['name']); ?>👋</h3>

                <!-- BUTTONS -->
                <a href="create_entry.php" class="button button-primary">Create Entry📙</a>
                <a href="myentries.php" class="button button-primary">My Entries📑</a>

                <?php if ($role === "admin"): ?>
                    <a href="edit_categories.php" class="button button-primary">Categories📚</a>
                    <a href="remove_users.php" class="button button-primary">Users🙍‍♂️</a>
                <?php endif; ?>

                <a href="modify_mydata.php" class="button button-primary">My Data🙂</a>
                <a href="actions/logout.php" class="button button-primary">Log out🚪</a>
            </div>
        <?php endif; ?>

        <?php if (!$user): ?>
            <!--LOGIN-->
            <div id="login" class="sidebar-block">
                <h3>Login</h3>

                <?php if (isset($_SESSION['error_login'])): ?>
                    <div class="alert alert-error">
                        <?= $_SESSION['error_login']; ?>
                    </div>
                    <?php unset($_SESSION['error_login']); ?>
                <?php endif; ?>

                <form action="actions/login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" />

                    <label for="password">Password</label>
                    <input type="password" name="password" />

                    <input class="button button-primary" type="submit" name="submit" value="Send🙂" />
                </form>
            </div>

            <!--REGISTER-->
            <div id="register" class="sidebar-block">
                
                <h3>Register</h3>

                <!-- SUCCESS / GENERAL ERROR MESSAGES -->
                <?php if (isset($_SESSION['successful'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['successful']; ?>
                    </div>
                <?php elseif (isset($_SESSION['errors']['general'])): ?>
                    <div class="alert alert-error">
                        <?= $_SESSION['errors']['general']; ?>
                    </div>
                <?php endif; ?>

                <?php 
                    // Load errors safely
                    $errors = $_SESSION['errors'] ?? [];
                ?>

                <form action="actions/register.php" method="POST">

                    <label for="name">Name</label>
                    <input type="text" name="name" />
                    <?= isset($errors['name']) ? "<p class='alert alert-error'>{$errors['name']}</p>" : "" ?>

                    <label for="surname">Surname</label>
                    <input type="text" name="surname" />
                    <?= isset($errors['surname']) ? "<p class='alert alert-error'>{$errors['surname']}</p>" : "" ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" />
                    <?= isset($errors['email']) ? "<p class='alert alert-error'>{$errors['email']}</p>" : "" ?>

                    <label for="password">Password</label>
                    <input type="password" name="password" />
                    <?= isset($errors['password']) ? "<p class='alert alert-error'>{$errors['password']}</p>" : "" ?>

                    <input class="button button-primary" type="submit" name="submit" value="Send📜" />
                </form>

                <?php removeErrors(); ?>
            </div>

        <?php endif; ?>
    </aside>
