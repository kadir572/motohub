<?php

  $motorcycle = new Motorcycle;
  $motorcycles = $motorcycle->findAll();

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/motorcycles.css">
    <title>Motohub | Motorcycles</title>
  </head>
  <body>
  <?php include_once 'partials/header.php'; ?>
  <main>
    <h1>Motorcycles</h1>
    <div class="motorcycle__list">
    <?php foreach($motorcycles as $motorcycle): ?>
      <div class="motorcycle__item">
      <span><?= $motorcycle->make?></span>
      <span><?= $motorcycle->model?></span>
      <div class="motorcycle__image-wrapper">
        <img src="<?= $motorcycle->imageUrl?>" alt="">
      </div>
      </div>
    <?php endforeach; ?>
    </div>
  </main>
  <?php include_once 'partials/footer.php'; ?>
  </body>
</html>