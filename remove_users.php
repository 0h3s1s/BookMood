<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div id="main">
  <h1 class="hover-underline">Remove Users</h1>
  <p>
    This is for users who are making a bad use of the website are not able to keep using the account. This will remove the actual user on the database and also all their entries made so far.
  </p>

  <!-- check if there are users in the database -->
  <?php
  $result = mysqli_query($db, "select * from users");
  $total_users = mysqli_num_rows($result);
  if ($total_users > 1):
    // GET ALL USERS
    $sql = "select id, name, surname, email from users order by id asc";
    $result = mysqli_query($db, $sql);
  ?>
    <br />

    <table border="1" cellpadding="10" style="border-collapse: collapse; width: 80%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Surname</th>
          <th>Email</th>
          <th>Remove</th>
        </tr>
      </thead>

      <tbody>
        <?php while ($user = mysqli_fetch_assoc($result)):
          if ($user['id'] != 1): ?>
            <tr>
              <td style="text-align: center;"><?= $user['id'] ?></td>
              <td style="text-align: center;"><?= $user['name'] ?></td>
              <td style="text-align: center;"><?= $user['surname'] ?></td>
              <td style="text-align: center;"><?= $user['email'] ?></td>
              <td style="text-align:center;">
                <a href="actions/remove-user.php?id=<?= $user['id'] ?>"
                  onclick="return confirm('¿Seguro que deseas eliminar este usuario?');"
                  style="font-size: 20px; text-decoration: none;">
                  ❌
                </a>

              </td>
            </tr>
        <?php endif;
        endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class='alert alert-error'>⛔There are no users yet⛔</div>
  <?php endif; ?>

</div>

<!-- FOOTER -->
<?php require_once 'includes/footer.php'; ?>