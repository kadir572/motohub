<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/admin/login');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/pages.css">
<title>Admin | Pages</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <h1>Admin Pages</h1>
    <div class="pages">
      <div class="page">
        <span>Motorcycles</span>
        <a class="btn btn--secondary" href="<?=ROOT?>/admin/motorcycles">Edit</a>
      </div>
    </div>
  </main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>