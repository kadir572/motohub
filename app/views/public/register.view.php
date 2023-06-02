
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/login.css">
  <title>User Login</title>
</head>
<body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
<main>
  <div class="bg-img"></div>
  <div class="container">
  <h2>User Registration</h2>
  <form method="POST" action="<?=ROOT?>/auth">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <input type="hidden" name="type" value="register">
    <input type="hidden" name="user" value="user">
    <div class="form__control">
      <input class="form__input" type="text" id="username" name="username" placeholder="Username">
      <label class="form__label" for="username">Username</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="email" id="email" name="email" placeholder="Email">
      <label class="form__label" for="email">Email</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="password" name="password" id="password" placeholder="Password">
      <label class="form__label" for="password">Password</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="password" name="password2" id="password2" placeholder="Repeat password">
      <label class="form__label" for="password2">Repeat password</label>
    </div>
    <button class="form__submit" type="submit">Register</button>
    <a class="link" href="<?=ROOT?>/home/login">Already have an account? Log in here</a>
  </form>
  </div>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>