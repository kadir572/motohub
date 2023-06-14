<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/public/login');
  }

  if ($_SESSION['permission'] === 1) {
    Validator::redirectWithError('401 - Unauthorized', '/admin');
    return;
  }

  $user = UserModel::first(['username' => $_SESSION['username']]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/user/settings.css">
<script src="<?=ROOT?>/assets/js/confirmModal.js" defer></script>
<title>MotoHub | Settings</title>
</head>
<body>
<div class="body__wrapper">
<?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <?php include_once '../app/views/common/partials/modal.php'; ?>
    <div class="bg-img"></div>
    <div class="container">
    <h1>User Settings</h1>
    <form action="<?=ROOT?>/user/edit" method="POST">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <h3>Change username</h3>
    <div class="form__control">
      <input type="hidden" name="id" value="<?=$user->id?>">
      <input class="form__input" type="text" id="username" name="username" placeholder="Username" <?= !empty($_GET['username']) ? 'value="'.$_GET['username'].'"' : '' ?>>
      <label class="form__label" for="username">Username</label>
    </div>
    <div class="requirements">
      <span>Requirements:</span>
      <ul>
        <li><a class="link" href="#currentPassword">Current password</a> field is required</li>
        <li>Username must be between 4 and 16 characters long</li>
        <li>Username can not contain blank spaces or special characters</li>
      </ul>
    </div>
    <hr>
    <h3>Change email</h3>
    <div class="form__control">
      <input class="form__input" type="email" id="email" name="email" placeholder="Email" <?= !empty($_GET['email']) ? 'value="'.$_GET['email'].'"' : '' ?>>
      <label class="form__label" for="email">Email</label>
    </div>
    <div class="requirements">
      <span>Requirements:</span>
      <ul>
        <li><a class="link" href="#currentPassword">Current password</a> field is required</li>
      </ul>
    </div>
    <hr>
    <h3>Change password</h3>
    <div class="form__control">
        <input type="password" name="currentPassword" id="currentPassword" class="form__input" placeholder="Current password">
        <label for="currentPassword" class="form__label">Current password</label>
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
        <li>Password must be at least 8 characters long</li>
        <li>Password can not contain blank spaces</li>
        <li>Password must contain at least one of each character: lower case, upper case, number, special character</li>
      </ul>
    </div>
    <div class="form__buttons">
    <button class="btn btn--secondary btn--medium" type="submit"><i class="fa-solid fa-floppy-disk"></i>Save</button>
      <button type="button" class="btn btn--primary btn--medium" onclick="showModal('Delete account', 'Are you sure you want to delete this account permanently?', '<?=ROOT?>/user/delete?id=<?=$user->id?>')"><i class="fa-solid fa-trash"></i>Delete account</button>
    </div>
    </form>
    
    
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</div>
</body>
</html>