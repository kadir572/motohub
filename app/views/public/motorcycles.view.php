<?php
  $motorcycles = MotorcycleModel::findAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/motorcycle/motorcycles.css">
    <script src="<?=ROOT?>/assets/js/motorcyclesFilter.js" defer></script>
    <script src="<?=ROOT?>/assets/js/compareMotorcycles.js" defer></script>
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div id="motorcyclesList" style="display:none"><?=json_encode($motorcycles)?></div>
    <div id="websiteRoot" style="display:none"><?=ROOT?></div>
    <div class="bg-img"></div>
    <div class="container">
      <h1>Motorcycles</h1>
      <div class="motorcycle__list__actions">
        <div class="form__control">
          <input type="text" name="search" id="search" class="form__input" placeholder="Search" autocomplete="off">
          <label for="search" class="form__label">Search</label>
        </div>
        <div class="compare__list"></div>
        <a href="<?=ROOT?>/home/motorcycles?type=compare" class="btn btn--secondary btn--medium compare__btn"><i class="fa-solid fa-check"></i>Compare</a>
      </div>
        <?php if ($motorcycles): ?>
          <div class="motorcycle__list">
          </div>
        <?php endif; ?>
      </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>