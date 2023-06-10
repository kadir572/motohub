<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/home/login');
  }

  if ($_SESSION['permission'] === 1) {
    Validator::redirectWithError('401 - Unauthorized', '/admin');
    return;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once '../app/views/common/partials/head-core.php'; ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/user/dashboard.css">
<title>MotoHub | Dashboard</title>
</head>
<body>
<?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
    <h1>Dashboard</h1>
    <?php include_once '../app/views/common/partials/notification.php';?>
    <h2>Welcome <?=$_SESSION['username']?></h2>
    
    <?php if (isset($_SESSION['username'])) : ?>
      <div class="session">
        <span style="color: #fff">SESSION DATA:</span><br>
        <?php foreach ($_SESSION as $key => $value) : ?>
          <?php if (is_array($value)){ ?>
            <?php foreach ($value as $key2 => $value2): ?>
              <span style="color: #fff">$_SESSION['<?=$key?>']['<?=$key2?>']&emsp;=>&emsp;<?=$value2?></span><br>
            <?php endforeach; ?>
          <?php } else { ?>
            <span style="color: #fff">$_SESSION['<?=$key?>']&emsp;=>&emsp;<?=$value?></span><br>
          <?php } ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
</body>
</html>