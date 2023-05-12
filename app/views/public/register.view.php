
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
  <h1>User Registration</h1>
  <?php
  if (!empty($_GET['error'])) {
    echo "<span>".$_GET['error']."</span>";
  }
  ?>
  <form method="POST" action="<?=ROOT?>/auth">
    <input type="hidden" name="type" value="register">
    <input type="hidden" name="user" value="user">
    <div class="form__control">
      <label class="form__label" for="username">Username</label>
      <input class="form__input" type="text" id="username" name="username">
    </div>
    <div class="form__control">
      <label class="form__label" for="email">Email</label>
      <input class="form__input" type="email" id="email" name="email">
    </div>
    <div class="form__control">
      <label class="form__label" for="password">Password</label>
      <input class="form__input" type="text" name="password" id="password">
    </div>
    <div class="form__control">
      <label class="form__label" for="password2">Repeat password</label>
      <input class="form__input" type="text" name="password2" id="password2">
    </div>
    <button class="form__submit" type="submit">Register</button>
  </form>
</main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>