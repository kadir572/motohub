<?php
  $motorcycle = MotorcycleModel::first(['id' => $data['id']]);
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/motorcycle/details.css">
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
    <h1>Motorcycles</h1>
    <div class="motorcycle__list">
      <div class="motorcycle__item">
      <span><?= $motorcycle->make?></span>
      <span><?= $motorcycle->model?></span>
      <div class="motorcycle__image-wrapper">
        <img src="<?= ROOT.'/'.$motorcycle->imagePath?>" alt="Image of <?=$motorcycle->make?> <?=$motorcycle->model?>">
      </div>
      </div>
    </div>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>