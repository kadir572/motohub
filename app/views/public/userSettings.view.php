<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/public/login');
  }

  if ($_SESSION['permission'] === 1) {
    redirectWithError('401 - Unauthorized', '/admin');
    return;
  }

  $userModel = new User();
  $user = $userModel->first(['username' => $_SESSION['username']]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/dashboard.css">
<title>User | Settings</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <h1>User Settings</h1>
    <?php include_once 'partials/notification.php'; ?>
    <a href="<?=ROOT?>/home/user?type=delete&id=<?=$user->id?>">Delete account</a>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>