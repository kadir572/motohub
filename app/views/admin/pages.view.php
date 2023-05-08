<?php
  if (empty($_SESSION['username'])) {
    array_push($_SESSION['errors'], '401 - Unauthorized');
    header("Location: ".ROOT."/admin/login");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/adminPages.css">
<title>Admin | Pages</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
  <h1>Admin Pages</h1>
  <div class="pages">
    <div class="page">
      <span>Motorcycles</span>
      <a href="<?=ROOT?>/admin/motorcycles">Edit</a>
    </div>
  </div>
  </main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>