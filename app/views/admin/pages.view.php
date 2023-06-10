<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/admin/login');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/pages.css">
<title>MotoHub | Pages</title>
</head>
<body>
<div class="body__wrapper">
<?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
    <h1>Admin Pages</h1>
    <div class="pages">
      <div class="page">
        <span>Motorcycles</span>
        <a class="btn btn--secondary btn--small" href="<?=ROOT?>/admin/motorcycles">Edit</a>
      </div>
    </div>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</div>
</body>
</html>