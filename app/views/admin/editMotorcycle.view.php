<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/admin/login');
  }

  $motorcycleModel = new MotorcycleModel();
  $motorcycle = $motorcycleModel->first(['id' => $data['id']]);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/edit.css">
    <title>Admin | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <div class="bg-img"></div>
      <h1>Admin Edit Motorcycle</h1>
      <form action="<?=ROOT?>/admin/motorcycles?type=update&id=<?=$motorcycle->id?>" method="POST" enctype="multipart/form-data">
        <?php include_once '../app/views/common/partials/notification.php';?>
        <div class="form__control">
          <input class="form__input" type="text" id="make" name="make" value="<?=ucfirst($motorcycle->make)?>" placeholder="Make">
          <label class="form__label" for="make">Make</label>
        </div>
        <div class="form__control">
          <input class="form__input" type="text" id="model" name="model" value="<?=ucfirst($motorcycle->model)?>" placeholder="Model">
          <label class="form__label" for="model">Model</label>
        </div>
        <div class="form__control">
          <input type="file" name="imageUpload" id="imageUpload" class="form__input">
          <label for="imageUpload" class="form__label">Upload image</label>
        </div>
        <button class="form__submit" type="submit">Save</button>
        <a class="form__submit" href="<?=ROOT?>/admin/motorcycles">Cancel</a>
      </form>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>