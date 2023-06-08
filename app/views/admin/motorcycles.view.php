<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/admin/login');
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
          <input type="text" name="search" id="search" class="form__input" placeholder="Search">
          <label for="search" class="form__label">Search</label>
        </div>
        <a class="btn btn--secondary btn-small" href="<?=ROOT?>/admin/motorcycles?type=new"><i class="fa-solid fa-plus"></i>New</a>
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
                <a class="btn btn--secondary btn--small" href="<?=ROOT?>/admin/motorcycles?type=edit&id=<?=$motorcycle->id?>"><i class="fa-solid fa-pen"></i>Edit</a>
                <button class="btn btn--primary btn--small" onclick="showModal('Delete item', 'Are you sure you want to delete this item?', '<?=ROOT?>/admin/motorcycles?type=remove&id=<?=$motorcycle->id?>')"><i class="fa-solid fa-trash"></i>Delete</button>
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