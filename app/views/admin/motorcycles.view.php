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
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <div class="bg-img"></div>
      <div class="container">
      <h1>Admin Motorcycles</h1>
      <a class="link" href="<?=ROOT?>/admin/motorcycles?type=new">New</a>
      <div class="motorcycles__list">
        <?php if ($motorcycles): ?>
          <?php foreach($motorcycles as $motorcycle): ?>
          <img src="<?=ROOT.'/'.$motorcycle->imagePath?>" alt="Thumbnail image of <?=$motorcycle->make?> <?=ucfirst($motorcycle->model)?>">
          <div><span><?=ucfirst($motorcycle->make)?></span></div>
          <div><span><?=ucfirst($motorcycle->model)?></span></div>
          <div><a class="link" href="<?=ROOT?>/admin/motorcycles?type=edit&id=<?=$motorcycle->id?>">Edit</a></div>
          <div><a class="link" href="<?=ROOT?>/admin/motorcycles?type=remove&id=<?=$motorcycle->id?>">Remove</a></div>
        <?php endforeach; ?>
        <?php else : ?>
          <span>No motorcycles found</span>
        <?php endif; ?>
      </div>
      </div>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>