
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/register.css">
  <title>MotoHub | Registration</title>
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
      <input class="form__input" type="text" id="username" name="username" placeholder="Username" autofocus <?= !empty($_GET['username']) ? 'value="'.$_GET['username'].'"' : '' ?>>
      <label class="form__label" for="username">Username</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="email" id="email" name="email" placeholder="Email" <?= !empty($_GET['email']) ? 'value="'.$_GET['email'].'"' : '' ?>>
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
    <div class="requirements">
          <span>Requirements:</span>
          <ul>
            <li>All fields are required</li>
            <li>Username must be between 4 and 16 characters long</li>
            <li>Username can not contain blank spaces or special characters</li>
            <li>Password must be at least 8 characters long</li>
            <li>Password can not contain blank spaces</li>
            <li>Password must contain at least one of each character: lower case, upper case, number, special character</li>
          </ul>
        </div>
    <button class="btn btn--neutral btn--medium" type="submit">Register</button>
    <span>Already have an account? <a href="<?=ROOT?>/home/login" class="link">Log in</a></span>
  </form>
  </div>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>