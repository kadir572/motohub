<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/admin/login');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/new.css">
    <script src="<?=ROOT?>/assets/js/fileUpload.js" defer type="module"></script>
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
    <div class="body__wrapper">
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
      <div class="bg-img"></div>
      <div class="container">
      <h1>Add Motorcycle</h1>
      <?php include_once '../app/views/common/partials/notification.php';?>
      <form action="<?=ROOT?>/admin/motorcycles?type=create" method="POST" enctype="multipart/form-data">
        
        <div class="form__control">
          <input class="form__input" type="text" id="make" name="make" placeholder="Make" <?= !empty($_GET['make']) ? 'value="'.$_GET['make'].'"': '' ?> autofocus>
          <label class="form__label" for="make">Make</label>
        </div>
        <div class="form__control">
          <input class="form__input" type="text" id="model" name="model" placeholder="Model" <?= !empty($_GET['model']) ? 'value="'.$_GET['model'].'"': '' ?>>
          <label class="form__label" for="model">Model</label>
        </div>
        <div class="form__control">
          <input type="text" class="form__input" id="year" name="year" placeholder="Year" <?= !empty($_GET['year']) ? 'value="'.$_GET['year'].'"': '' ?>>
          <label for="year" class="form__label">Year</label>
        </div>
        <div class="form__control">
          <input type="text" class="form__input" id="displacement" name="displacement" placeholder="Displacement" <?= !empty($_GET['displacement']) ? 'value="'.$_GET['displacement'].'"': '' ?>><span>cc</span>
          <label for="displacement" class="form__label">Displacement</label>
        </div>
        <div class="form__control__group">
        <div class="form__control">
          <input type="text" class="form__input" id="horsepower" name="horsepower" placeholder="Horsepower" <?= !empty($_GET['horsepower']) ? 'value="'.$_GET['horsepower'].'"': '' ?>><span>hp</span>
          <label for="horsepower" class="form__label">Horsepower</label>
        </div>
        <span>@</span>
        <div class="form__control">
          <input type="text" class="form__input" id="peakHorsepowerRpm" name="peakHorsepowerRpm" placeholder="Rpm" <?= !empty($_GET['peakHorsepowerRpm']) ? 'value="'.$_GET['peakHorsepowerRpm'].'"': '' ?>><span>rpm</span>
          <label for="peakHorsepowerRpm" class="form__label">Rpm</label>
        </div>
        </div>
        <div class="form__control__group">
        <div class="form__control">
          <input type="text" class="form__input" id="torque" name="torque" placeholder="Torque" <?= !empty($_GET['torque']) ? 'value="'.$_GET['torque'].'"': '' ?>><span>nm</span>
          <label for="torque" class="form__label">Torque</label>
        </div>
        <span>@</span>
        <div class="form__control">
          <input type="text" class="form__input" id="peakTorqueRpm" name="peakTorqueRpm" placeholder="Rpm" <?= !empty($_GET['peakTorqueRpm']) ? 'value="'.$_GET['peakTorqueRpm'].'"': '' ?>><span>rpm</span>
          <label for="peakTorqueRpm" class="form__label">Rpm</label>
        </div>
        </div>
          <div class="form__control--file">
            <input type="file" class="form__input--file" id="imageUpload" name="imageUpload">
            <label for="imageUpload" class="form__label--file" id="imageUploadLabel"><i class="fa-solid fa-upload"></i><span></span></label>
            <img id="imageUploadImg" src="https://images.placeholders.dev?height=750&width=1000&text=Upload image&textColor=#000&bgColor=#fff" alt="">
          </div>
          <div class="requirements">
          <span>Requirements:</span>
          <ul>
            <li>All fields are required</li>
            <li>File min height: 600px</li>
            <li>File min width: 800px</li>
            <li>File aspect ratio: 4/3</li>
            <li>Allowed file types: image/jpeg, image/png, image/webp</li>
          </ul>
        </div>
        <div class="form__buttons">
        <button class="btn btn--secondary btn--medium" type="submit"><i class="fa-solid fa-floppy-disk"></i>Save</button>
        <a class="btn btn--primary btn--medium" href="<?=ROOT?>/admin/motorcycles"><i class="fa-solid fa-ban"></i>Cancel</a>
        </div>
      </form>
      </div>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
    </div>
  </body>
</html>