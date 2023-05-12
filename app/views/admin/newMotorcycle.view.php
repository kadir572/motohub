<?php
  if (empty($_SESSION['username'])) {
    array_push($_SESSION['errors'], '401 - Unauthorized');
    header("Location: ".ROOT."/admin/login");
  }

  $motorcycleModel = new Motorcycle();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once 'partials/head-core.php'; ?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/admin/motorcycle/new.css">
    <title>Admin | Motorcycles</title>
  </head>
  <body>
    <?php include_once 'partials/header.php'; ?>
    <main>
    <h1>Admin New Motorcycle</h1>
    <form action="<?=ROOT?>/admin/motorcycles?type=create" method="POST">
      <div class="form__control">
        <label class="form__label" for="make">Make</label>
        <input class="form__input" type="text" id="make" name="make">
      </div>
      <div class="form__control">
        <label class="form__label" for="model">Model</label>
        <input class="form__input" type="text" id="model" name="model">
      </div>
      <div class="form__control">
        <label class="form__label" for="imageUrl">Image Url</label>
        <input class="form__input" type="text" id="imageUrl" name="imageUrl">
      </div>
      <button type="submit">Save</button>
      <a href="<?=ROOT?>/admin/motorcycles">Cancel</a>
    </form>
    </main>
    <?php include_once 'partials/footer.php'; ?>
  </body>
</html>