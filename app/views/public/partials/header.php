<?php

function setActiveLink($page = '') {
  $URL = splitUrl();
  
  if (isset($URL[1])) {
    if ($page === $URL[1]) {
      return 'class="active"';
    }
  } elseif (!isset($URL[1])) {
    if ($URL[0] === 'home' && $page === '') {
      return 'class="active"';
    }
  }
}

function isUserLoggedIn() {
  return isset($_SESSION['username']) && !empty($_SESSION['username'] && !empty($_SESSION['permission'] && $_SESSION['permission'] === 0)) ? true : false;
}

?>

<header>
  <div class="header__container">
    <a class="header__logo" href="<?=ROOT?>">MotoHub</a>
    <div class="mode-switch">Icon</div>
    <nav class="header__nav">
      <a <?= setActiveLink() ?> href="<?=ROOT?>">Home</a>
      <a <?= setActiveLink('motorcycles') ?> href="<?=ROOT?>/home/motorcycles">Motorcycles</a>
      <a <?= setActiveLink('contact') ?> href="<?=ROOT?>/home/contact">Contact</a>
      <?php if (isset($_SESSION['permission']) && $_SESSION['permission'] === 0) { ?>
        <a <?= setActiveLink('dashboard') ?> href="<?=ROOT?>/home/dashboard">Dashboard</a>
        <a href="<?=ROOT?>/auth/logout">Logout</a>
        <a <?= setActiveLink('user') ?> href="<?=ROOT?>/home/userSettings">Settings</a>
      <?php } else { ?>
        <a <?= setActiveLink('login') ?> href="<?=ROOT?>/home/login">Login</a>
        <a <?= setActiveLink('register') ?> href="<?=ROOT?>/home/register">Register</a>
      <?php } ?>
      
      
    </nav>
  </div>
</header>