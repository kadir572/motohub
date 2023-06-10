<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/admin/login');
  }
  $motorcycles = MotorcycleModel::findAll();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/motorcycles.css">
    <script src="<?=ROOT?>/assets/js/confirmModal.js" defer></script>
    <script src="<?=ROOT?>/assets/js/motorcyclesFilter.js" defer></script>
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <?php include_once '../app/views/common/partials/modal.php'; ?>
      <div id="motorcyclesList" style="display:none"><?=json_encode($motorcycles)?></div>
      <div id="websiteRoot" style="display:none"><?=ROOT?></div>
      <div class="bg-img"></div>
      <div class="container">
      <h1>Listed Motorcycles</h1>
      <div class="motorcycle__list__actions">
        <div class="form__control">
          <input type="text" name="search" id="search" class="form__input" placeholder="Search" autocomplete="off">
          <label for="search" class="form__label">Search</label>
        </div>
        <a class="btn btn--secondary btn-small" href="<?=ROOT?>/admin/motorcycles?type=new"><i class="fa-solid fa-plus"></i>New</a>
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