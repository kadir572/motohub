<?php
  if (!isset($_GET['selector']) || !isset($_GET['validator'])) {
    Validator::redirectWithError("Could not validate your request", "/resetpwd/resetPasswordForm");
    return;
  }

  $selector = Utility::sanitize(trim($_GET['selector']));
  $validator = Utility::sanitize(trim($_GET['validator']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/resetPassword.css">
  <title>MotoHub | User Reset Password</title>
</head>
<body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
<main>
  <div class="bg-img"></div>
  <div class="container">
  <h2>User Reset Password</h2>
  <form method="POST" action="<?=ROOT?>/resetpwd/reset">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <input type="hidden" name="selector" value="<?= $selector?>">
    <input type="hidden" name="validator" value="<?= $validator?>">
    <div class="form__control">
      <input class="form__input" type="password" name="password" id="password" placeholder="Password">
      <label class="form__label" for="password">Password</label>
    </div>
    <div class="form__control">
      <input class="form__input" type="password" name="password2" id="password2" placeholder="Repeat password">
      <label class="form__label" for="password2">Repeat password</label>
    </div>
    <button class="form__submit" type="submit">Register</button>
  </form>
  </div>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>