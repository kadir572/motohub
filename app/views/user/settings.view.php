<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/public/login');
  }

  if ($_SESSION['permission'] === 1) {
    redirectWithError('401 - Unauthorized', '/admin');
    return;
  }

  $user = UserModel::first(['username' => $_SESSION['username']]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/user/settings.css">
<title>MotoHub | Settings</title>
</head>
<body>
<?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
    <h1>User Settings</h1>
    <?php include_once '../app/views/common/partials/notification.php';?>
    <a class="link" href="<?=ROOT?>/home/user/delete?id=<?=$user->id?>">Delete account</a>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>