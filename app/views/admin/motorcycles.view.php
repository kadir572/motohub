<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/admin/login');
  }

  $motorcycleModel = new Motorcycle();
  $motorcycles = $motorcycleModel->findAll();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/motorcycles.css">
    <title>Admin | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <div class="bg-img"></div>
      <h1>Admin Motorcycles</h1>
      <a class="link" href="<?=ROOT?>/admin/motorcycles?type=new">New</a>
      <div class="motorcycles__list">
        <?php foreach($motorcycles as $motorcycle): ?>
          <img src="<?=$motorcycle->imageUrl?>" alt="Thumbnail image of <?=$motorcycle->make?> <?=ucfirst($motorcycle->model)?>">
          <div><span><?=$motorcycle->make?></span></div>
          <div><span><?=$motorcycle->model?></span></div>
          <div><a class="link" href="<?=ROOT?>/admin/motorcycles?type=edit&id=<?=$motorcycle->id?>">Edit</a></div>
          <div><a class="link" href="<?=ROOT?>/admin/motorcycles?type=remove&id=<?=$motorcycle->id?>">Remove</a></div>
        <?php endforeach; ?>
      </div>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>