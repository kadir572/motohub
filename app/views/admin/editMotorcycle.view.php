<?php
  if (empty($_SESSION['username'])) {
    array_push($_SESSION['errors'], '401 - Unauthorized');
    header("Location: ".ROOT."/admin/login");
  }

  $motorcycleModel = new Motorcycle();
  $motorcycle = $motorcycleModel->first(['id' => $data['id']]);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once 'partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/edit.css">
    <title>Admin | Motorcycles</title>
  </head>
  <body>
    <?php include_once 'partials/header.php'; ?>
    <main>
    <h1>Admin Edit Motorcycle</h1>
    <form action="<?=ROOT?>/admin/motorcycles?type=update&id=<?=$motorcycle->id?>" method="POST">
      <div class="form__control">
        <label class="form__label" for="make">Make</label>
        <input class="form__input" type="text" id="make" name="make" value="<?=ucfirst($motorcycle->make)?>">
      </div>
      <div class="form__control">
        <label class="form__label" for="model">Model</label>
        <input class="form__input" type="text" id="model" name="model" value="<?=ucfirst($motorcycle->model)?>">
      </div>
      <div class="form__control">
        <label class="form__label" for="imageUrl">Image Url</label>
        <input class="form__input" type="text" id="imageUrl" name="imageUrl" value="<?=$motorcycle->imageUrl?>">
      </div>
      <button type="submit">Save</button>
      <a href="<?=ROOT?>/admin/motorcycles">Cancel</a>
    </form>
    </main>
    <?php include_once 'partials/footer.php'; ?>
  </body>
</html>