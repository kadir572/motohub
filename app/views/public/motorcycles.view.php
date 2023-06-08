<?php
  $motorcycles = MotorcycleModel::findAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/motorcycle/motorcycles.css">
    <script src="<?=ROOT?>/assets/js/motorcyclesFilter.js" defer></script>
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
          <input type="text" name="search" id="search" class="form__input" placeholder="Search">
          <label for="search" class="form__label">Search</label>
        </div>
      </div>
        <?php if ($motorcycles): ?>
          <div class="motorcycle__list">
          <?php foreach ($motorcycles as $motorcycle): ?>
            <div class="motorcycle__item">
              <img src="<?=ROOT?>/<?=$motorcycle->imagePath?>" alt="<?=ucfirst($motorcycle->make)?> <?=ucfirst($motorcycle->model)?> image">
              <div class="motorcycle__info">
                <span><?=ucfirst($motorcycle->make)?></span>
                <span><?=ucfirst($motorcycle->model)?></span>
              </div>
              <div class="motorcycle__buttons">
                <a class="btn btn--secondary btn--small" href="<?=ROOT?>/home/motorcycles?type=details&id=<?=$motorcycle->id?>"><i class="fa-solid fa-circle-info"></i>Details</a>
              </div>
            </div>
          <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>