<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/forgottenPassword.css">
  <title>MotoHub | Forgotten Password</title>
</head>
<body>
  <div class="body__wrapper">
  <?php include_once '../app/views/common/partials/header.php'; ?>
<main>
  <div class="bg-img"></div>
  <div class="container">
  <h2>Forgotten Password</h2>
  <form method="POST" action="<?=ROOT?>/resetpwd/sendRequest">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <div class="form__control">
      <input class="form__input" type="email" id="email" name="email" placeholder="Email">
      <label class="form__label" for="email">Email</label>
    </div>
    <button class="btn btn--neutral btn--medium" type="submit">Submit</button>
  </form>
  </div>
</main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </div>
</body>
</html>