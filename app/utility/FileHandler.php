<?php

class FileHandler {
  private static $maxFileSize = 10048576;
  private static $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/webp'];

  private static function checkError($file, $path, $queries = []) {
    if ($file['error'] !== 0) {
      switch ($file['error']) {
        case 1:
        case 2:
          redirectWithError('Filesize too large', $path, $queries);
          break;
        case 3:
          redirectWithError('File incomplete', $path, $queries);
          break;
        case 4:
          redirectWithError('File missing', $path, $queries);
          break;
        case 6:
        case 7:
        case 8:
          redirectWithError('500 - Internal error', $path, $queries);
          break;
        default:
          header("Location: ". ROOT);
          break;
      }
    }
    
    return true;
  }

  private static function checkMaxFileSize($file, $path, $queries = []) {
    if ($file['size'] > self::$maxFileSize) {
      return redirectWithError('Filesize too large', $path, $queries);
    }
    return true;
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
    rename(UPLOAD_PATH.'/'.$filename, $destDirPath.'/'.$destFilename.'.'.$fileExtension);

    return $destDirPath.'/'.$destFilename.'.'.$fileExtension;
  }

  public static function removeFile($path) {
    return unlink($path);
  }
}