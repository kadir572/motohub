<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/login.css">
  <title>User Login</title>
</head>
<body>
  <?php include_once 'partials/header.php'; ?>
<main>
  <div class="bg-img"></div>
  <h2>User Login</h2>
  <form method="POST" action="<?=ROOT?>/auth">
    <?php include_once 'partials/notification.php'; ?>
    <input type="hidden" name="type" value="login">
    <input type="hidden" name="user" value="user">
    <div class="form__control">
      <input class="form__input" type="text" id="username" name="username" placeholder="Username">
      <label class="form__label" for="username">Username</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="password" name="password" id="password" placeholder="Password">
      <label class="form__label" for="password">Password</label>
    </div>
    <button class="form__submit" type="submit">Login</button>
    <a class="link" href="<?=ROOT?>/resetpwd">Forgot password?</a>
  </form>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>