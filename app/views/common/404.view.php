<!DOCTYPE html>
<html>
  <head>
    <?php include_once '../app/views/common/partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/404.css">
    <title>MotoHub | 404 Not Found</title>
  </head>
  <body>
  <?php include_once '../app/views/common/partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <div class="container">
    <h1>Oops!</h1>
    <h2>404 - Page not found</h2>
    <p>The resource you are looking for does not exist.</p>
    <div class="buttons">
      <a class="link" href="javascript:history.go(-1)">Go back</a>
      <a class="link" href="<?=ROOT?>">Go to homepage</a>
    </div>
    </div>
  </main>
  <?php include_once '../app/views/common/partials/footer.php'; ?>
  </body>
</html>