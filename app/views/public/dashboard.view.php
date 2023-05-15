<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/home/login');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/dashboard.css">
<title>Admin | Dashboard</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <h1>User Dashboard</h1>
    <h2>Welcome <?=$_SESSION['username']?></h2>
  </main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>