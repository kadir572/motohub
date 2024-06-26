<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/login.css">
  <title>MotoHub | Login</title>
</head>
<body>
  <div class="body__wrapper">
  <?php include_once '../app/views/common/partials/header.php'; ?>
<main>
  <div class="bg-img"></div>
  <div class="container">
  <h2>User Login</h2>
  <form method="POST" action="<?=ROOT?>/auth">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <input type="hidden" name="type" value="login">
    <input type="hidden" name="user" value="user">
    <div class="form__control">
      <input class="form__input" type="text" id="username" name="username" placeholder="Username" autofocus>
      <label class="form__label" for="username">Username</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="password" name="password" id="password" placeholder="Password">
      <label class="form__label" for="password">Password</label>
    </div>
    <button class="btn btn--neutral btn--medium" type="submit">Login</button>
    <div class="links">
    <a class="link" href="<?=ROOT?>/resetpwd">Forgot password?</a>
    <span>No account? <a class="link" href="<?=ROOT?>/home/register">Sign up</a></span>
    </div>
  </form>
  </div>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </div>
</body>
</html>