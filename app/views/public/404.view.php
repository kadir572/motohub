<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/404.css">
    <title>Motohub | 404 Not Found</title>
  </head>
  <body>
  <?php include_once 'partials/header.php'; ?>
  <main>
    <h1>Oops!</h1>
    <h2>404 - Page not found</h2>
    <p>The resource you are looking for does not exist.</p>
    <div class="buttons">
      <a href="javascript:history.go(-1)">Go back</a>
      <a href="<?=ROOT?>">Go to homepage</a>
    </div>
  </main>
  <?php include_once 'partials/footer.php'; ?>
  </body>
</html>