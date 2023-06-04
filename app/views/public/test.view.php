<?php

if (isset($_FILES['myFile'])) {
  // FileHandler::upload($_FILES['myFile'], '/home/test');
  // FileHandler::moveFile();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <form method="POST" enctype="multipart/form-data">
    <?php include_once '../app/views/common/partials/notification.php';?>
    <label for="myFile">File upload</label>
    <input type="file" name="myFile" id="myFile" accept="image/*">
    <button type="submit">Submit</button>
  </form>
</body>
</html>