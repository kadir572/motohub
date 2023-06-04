<?php
  if (empty($_SESSION['username'])) {
    redirectWithError('401 - Unauthorized', '/admin/login');
  }

  $motorcycleModel = new MotorcycleModel();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/new.css">
    <script src="<?=ROOT?>/assets/js/fileUpload.js" defer type="module"></script>
    <title>Admin | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <div class="bg-img"></div>
      <div class="container">
      <h1>Add Motorcycle</h1>
      <form action="<?=ROOT?>/admin/motorcycles?type=create" method="POST" enctype="multipart/form-data">
        <?php include_once '../app/views/common/partials/notification.php';?>
        <div class="form__control">
          <input class="form__input" type="text" id="make" name="make" placeholder="Make" <?= !empty($_GET['make']) ? 'value="'.$_GET['make'].'"': '' ?>>
          <label class="form__label" for="make">Make</label>
        </div>
        <div class="form__control">
          <input class="form__input" type="text" id="model" name="model" placeholder="Model" <?= !empty($_GET['model']) ? 'value="'.$_GET['model'].'"': '' ?>>
          <label class="form__label" for="model">Model</label>
        </div>
          <div class="form__control--file">
            <input type="file" class="form__input--file" id="imageUpload" name="imageUpload">
            <label for="imageUpload" class="form__label--file" id="imageUploadLabel"><i class="fa-solid fa-upload"></i><span></span></label>
            <img id="imageUploadImg" src="https://images.placeholders.dev?height=750&width=1000&text=Upload image&textColor=#000&bgColor=#fff" alt="">
          </div>
        <button class="form__submit" type="submit">Save</button>
        <a class="form__submit" href="<?=ROOT?>/admin/motorcycles">Cancel</a>
      </form>
      </div>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>