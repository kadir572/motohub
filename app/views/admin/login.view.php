<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/adminLogin.css">
  <title>Admin Login</title>
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
<main>
  <?php
  if (!empty($_SESSION['errors'])) {
    foreach($_SESSION['errors'] as $error) {
      echo "<span>$error</span>";
    }
  }
  ?>
  <form method="POST" action="../auth/login">
    <input type="hidden" name="type" value="login">
    <div class="form__control">
      <label class="form__label" for="username">Username</label>
      <input class="form__input" type="text" id="username" name="username">
    </div>
    <div class="form__control">
      <label class="form__label" for="password">Password</label>
      <input class="form__input" type="password" name="password" id="password">
    </div>
    <button class="form__submit" type="submit">Login</button>
  </form>
</main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>