<?php
  if (empty($_SESSION['username'])) {
    Validator::redirectWithError('401 - Unauthorized', '/admin/login');
  }

  $motorcycleModel = new MotorcycleModel();
  $motorcycle = MotorcycleModel::first(['id' => $data['id']]);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/edit.css">
    <script src="<?=ROOT?>/assets/js/fileUpload.js" defer type="module"></script>
    <script src="<?=ROOT?>/assets/js/confirmModal.js" defer></script>
    <title>MotoHub | Motorcycles</title>
  </head>
  <body>
    <?php include_once '../app/views/common/partials/header.php'; ?>
    <main>
    <?php include_once '../app/views/common/partials/modal.php'; ?>
      <div class="bg-img"></div>
      <div class="container">
      <h1>Edit Motorcycle</h1>
      <form action="<?=ROOT?>/admin/motorcycles?type=update&id=<?=$motorcycle->id?>" method="POST" enctype="multipart/form-data">
        <?php include_once '../app/views/common/partials/notification.php';?>
        <input type="hidden" name="originalMake" value="<?=$motorcycle->make?>">
        <input type="hidden" name="originalModel" value="<?=$motorcycle->model?>">
        <div class="form__control">
          <input class="form__input" type="text" id="make" name="make" value="<?=ucfirst($motorcycle->make)?>" placeholder="Make">
          <label class="form__label" for="make">Make</label>
        </div>
        <div class="form__control">
          <input class="form__input" type="text" id="model" name="model" value="<?=ucfirst($motorcycle->model)?>" placeholder="Model">
          <label class="form__label" for="model">Model</label>
        </div>
        <div class="form__control">
          <input type="text" class="form__input" id="year" name="year" placeholder="Year" value="<?=$motorcycle->year?>">
          <label for="year" class="form__label">Year</label>
        </div>
        <div class="form__control">
          <input type="text" class="form__input" id="displacement" name="displacement" placeholder="Displacement" value="<?=$motorcycle->displacement?>"><span>cc</span>
          <label for="displacement" class="form__label">Displacement</label>
        </div>
        <div class="form__control__group">
        <div class="form__control">
          <input type="text" class="form__input" id="horsepower" name="horsepower" placeholder="Horsepower" value="<?=$motorcycle->horsepower?>"><span>hp</span>
          <label for="horsepower" class="form__label">Horsepower</label>
        </div>
        <span>@</span>
        <div class="form__control">
          <input type="text" class="form__input" id="peakHorsepowerRpm" name="peakHorsepowerRpm" placeholder="Rpm" value="<?=$motorcycle->peakHorsepowerRpm?>"><span>rpm</span>
          <label for="peakHorsepowerRpm" class="form__label">rpm</label>
        </div>
        </div>
        <div class="form__control__group">
        <div class="form__control">
          <input type="text" class="form__input" id="torque" name="torque" placeholder="Torque" value="<?=$motorcycle->torque?>"><span>nm</span>
          <label for="torque" class="form__label">Torque</label>
        </div>
        <span>@</span>
        <div class="form__control">
          <input type="text" class="form__input" id="peakTorqueRpm" name="peakTorqueRpm" placeholder="Rpm" value="<?=$motorcycle->peakTorqueRpm?>"><span>rpm</span>
          <label for="peakTorqueRpm" class="form__label">Rpm</label>
        </div>
        </div>
        <div class="form__control--file">
            <input type="file" class="form__input--file" id="imageUpload" name="imageUpload">
            <label for="imageUpload" class="form__label--file" id="imageUploadLabel"><i class="fa-solid fa-upload"></i><span></span></label>
            <img id="imageUploadImg" src="<?=ROOT?>/<?=$motorcycle->imagePath?>" alt="">
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
        <a class="btn btn--neutral btn--medium" href="<?=ROOT?>/admin/motorcycles"><i class="fa-solid fa-ban"></i>Cancel</a>
        <button type="button" class="btn btn--primary btn--medium" onclick="showModal('Delete item', 'Are you sure you want to delete this item?', '<?=ROOT?>/admin/motorcycles?type=remove&id=<?=$motorcycle->id?>')"><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
      </form>
      </div>
    </main>
    <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>