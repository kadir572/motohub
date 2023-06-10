<!DOCTYPE html>
<html>
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/motorcycle/compare.css">
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
      <div class="grid" style="grid-template-columns: <?= '1fr repeat(' . count($data) . ', 3fr)'; ?>">
        <span>Image</span>
        <?php foreach ($data as $motorcycle): ?>
          <img src="<?=ROOT?>/<?=$motorcycle->imagePath?>" alt="<?=$motorcycle->make. ' ' . $motorcycle->model . ' image'?>">
        <?php endforeach; ?>
        <span>Name</span>
        <?php foreach ($data as $motorcycle): ?>
          <span><?=ucfirst($motorcycle->make)?> <?=ucfirst($motorcycle->model)?></span>
        <?php endforeach; ?>
        <span>Displacement</span>
        <?php foreach ($data as $motorcycle): ?>
          <span><?=$motorcycle->displacement?> cc</span>
        <?php endforeach; ?>
        <span>Horsepower</span>
        <?php foreach ($data as $motorcycle): ?>
          <span><?=$motorcycle->horsepower?> hp @ <?=$motorcycle->peakHorsepowerRpm?> rpm</span>
        <?php endforeach; ?>
        <span>Torque</span>
        <?php foreach ($data as $motorcycle): ?>
          <span><?=$motorcycle->torque?> nm @ <?=$motorcycle->peakTorqueRpm?> rpm</span>
        <?php endforeach; ?>
      </div>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>