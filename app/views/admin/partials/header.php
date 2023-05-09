<?php

function setActiveLink($page = '') {
  $URL = splitUrl();
  
  if (isset($URL[1])) {
    if ($page === $URL[1]) {
      return 'class="active"';
    }
  } elseif (!isset($URL[1])) {
    if ($URL[0] === 'admin' && $page === '') {
      return 'class="active"';
    }
  }
}

function isAdminLoggedIn() {
  return isset($_SESSION['username']) && !empty($_SESSION['username'] && !empty($_SESSION['permission'] && $_SESSION['permission'] === 1)) ? true : false;
}

?>

<header>
  <div class="header__container">
    <a class="header__logo" href="<?=ROOT?>">MotoHub</a>
    <div class="mode-switch">Icon</div>
    <nav class="header__nav">
      <?php if (isAdminLoggedIn()) { ?>
        <a <?= setActiveLink('dashboard') ?> href="<?=ROOT?>/admin/dashboard">Dashboard</a>
        <a <?= setActiveLink('pages') ?> href="<?=ROOT?>/admin/pages">Pages</a>
        <a href="<?=ROOT?>/auth/logout">Logout</a>
      <?php } else { ?>
        <a href="<?=ROOT?>">Public Homepage</a>
        <a <?= setActiveLink('login') ?> href="<?ROOT?>/admin/login">Login</a>
      <?php } ?>
    </nav>
  </div>
</header>