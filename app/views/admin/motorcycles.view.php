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
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/adminMotorcycles.css">
<title>Admin | Motorcycles</title>
</head>
<body>
<?php include_once 'partials/header.php'; ?>
  <main>
  <h1>Admin Motorcycles</h1>
  </main>
  <?php include_once 'partials/footer.php'; ?>
</body>
</html>