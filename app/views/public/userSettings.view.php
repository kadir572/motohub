<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/public/login');
  }

  $userModel = new User();
  $user = $userModel->first(['username' => $_SESSION['username']]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/dashboard.css">
<title>User | Settings</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <h1>User Settings</h1>
    <a href="<?=ROOT?>/home/user?type=delete&id=<?=$user->id?>">Delete account</a>
  </main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>