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
  return isset($_SESSION['username']) && !empty($_SESSION['username'] && isset($_SESSION['permission'])) ? true : false;
}

?>

<header>
  <div class="header__container">
    <a class="header__logo__link" href="<?=ROOT?>"><img class="header__logo" src="<?=ROOT?>/assets/images/logo-white.svg" alt="Motohub logo"></a>
    <div class="mode-switch">Icon</div>
    <nav class="header__nav">
      <a <?= setActiveLink() ?> href="<?=ROOT?>">Home</a>
      <a <?= setActiveLink('motorcycles') ?> href="<?=ROOT?>/home/motorcycles">Motorcycles</a>
      <a <?= setActiveLink('contact') ?> href="<?=ROOT?>/home/contact">Contact</a>
      <?php if (isUserLoggedIn()) { ?>
        <?php if ($_SESSION['permission'] === 0) : ?>
          <a <?= setActiveLink('dashboard') ?> href="<?=ROOT?>/home/dashboard">Dashboard</a>
          <a <?= setActiveLink('user') ?> href="<?=ROOT?>/home/userSettings">Settings</a>
        <?php endif; ?>
        <a href="<?=ROOT?>/auth/logout">Logout</a>
      <?php } else { ?>
        <a <?= setActiveLink('login') ?> href="<?=ROOT?>/home/login">Login</a>
        <a <?= setActiveLink('register') ?> href="<?=ROOT?>/home/register">Register</a>
      <?php } ?>
      
      
    </nav>
  </div>
</header>