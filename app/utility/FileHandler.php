<?php

class FileHandler {
  private static $maxFileSize = 10048576;
  private static $minImageWidth = 800;
  private static $minImageHeight = 600;
  private static $imageAspectRatio = 4/3;
  private static $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/webp'];

  private static function checkError($file, $path, $queries = []) {
    $hasErr = false;
    $errMsg = '';
    if ($file['error'] !== 0) {
      $hasErr = true;
      switch ($file['error']) {
        case 1:
        case 2:
          $errMsg = 'Filesize too large';
          break;
        case 3:
          $errMsg = 'FIle incomplete';
          break;
        case 4:
          $errMsg = 'File missing';
          break;
        case 6:
        case 7:
        case 8:
          $errMsg = '500 - Internal error';
          break;
        default:
          header("Location: ". ROOT);
          break;
      }
    }
    
    return $hasErr ? redirectWithError($errMsg, $path, $queries) : true;
  }

  private static function checkMaxFileSize($file, $path, $queries = []) {
    if ($file['size'] > self::$maxFileSize) {
      return redirectWithError('Filesize too large', $path, $queries);
    }
    return true;
  }

  private static function checkImageSize($file, $path, $queries = []) {
    $hasErr = false;
    $errMsg = '';
    $dimensions = getimagesize($file['tmp_name']);
    switch ($dimensions) {
      case $dimensions[0] < self::$minImageWidth:
        $hasErr = true;
        $errMsg = 'Image width too small (expected min width: '. self::$minImageWidth .', received: '.$dimensions[0].')';
        break;
      case $dimensions[1] < self::$minImageHeight:
        $hasErr = true;
        $errMsg = 'Image height too small (expected min height: '. self::$minImageHeight .', received: '.$dimensions[1].')';
        break;
      case $dimensions[0] / $dimensions[1] !== self::$imageAspectRatio:
        $hasErr = true;
        $errMsg = 'Aspect ratio incorrect (expected: '. self::$imageAspectRatio .', received: '.$dimensions[0] . '/' . $dimensions[1].')';
        break;
    }

    return $hasErr ? redirectWithError($errMsg, $path, $queries) : true;
  }

  private static function checkMimeType($file, $path, $queries = []) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, self::$allowedMimeTypes)) {
      return redirectWithError('Unsupported file type', $path, $queries);
    }

    return true;
  }

  private static function validateName($file) {
    $pathInfo = pathinfo($file['name']);
    $base = $pathInfo['filename'];
    $base = preg_replace("/[^\w-]/", "_", $base);
    return ['base' => $base, 'pathInfo' => $pathInfo, 'filename' => $base . '.' . $pathInfo['extension']];
  }

  public static function upload($file, $path, $queries = []) {

    if (!self::checkError($file, $path, $queries)) return;
    if (!self::checkMaxFileSize($file, $path, $queries)) return;
    if (!self::checkMimeType($file, $path, $queries)) return;
    if (!self::checkImageSize($file, $path, $queries)) return;

    $validatedName = self::validateName($file);
    $base = $validatedName['base'];
    $pathInfo = $validatedName['pathInfo'];
    $filename = $validatedName['filename'];

    $destination = UPLOAD_PATH .'/'.$filename;  

    $i = 1;

    while (file_exists($destination)) {
      $filename = $base . "($i)." . $pathInfo['extension'];
      $destination = UPLOAD_PATH .'/'.$filename;
      $i++;
    }

    if (!file_exists(UPLOAD_PATH)) {
      mkdir(UPLOAD_PATH, 0777, true);
    }


    if (!move_uploaded_file($file['tmp_name'], $destination )) {
      return redirectWithError('File upload failed', $path, $queries);
    }

    return true;
  }

  public static function moveFile($destDirPath, $destFilename) {
    if (count(scandir(UPLOAD_PATH)) <= 2) return;

    $filename = scandir(UPLOAD_PATH)[2];
    $fileExtension = explode('.', $filename)[1];
    
    $i = 1;

    while (file_exists($destDirPath.'/'.$destFilename.'.'.$fileExtension)) {
      $destFilename = $destFilename . "($i)";
      $i++;
    }

    $destFilePath = $destDirPath.'/'.$destFilename.'.'.$fileExtension;
    rename(UPLOAD_PATH.'/'.$filename, $destFilePath);
    return $destFilePath;
  }

  public static function removeFile($path) {
    return unlink($path);
  }
}