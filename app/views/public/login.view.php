<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/login.css">
  <title>User Login</title>
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
<main>
  <h1>User Login</h1>
  <?php
  if (!empty($_GET['error'])) {
    echo "<span>".$_GET['error']."</span>";
  }
  ?>
  <form method="POST" action="<?=ROOT?>/auth">
    <input type="hidden" name="type" value="login">
    <input type="hidden" name="user" value="user">
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