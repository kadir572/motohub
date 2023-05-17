<?php
$URL = splitUrl();
$isAdminRoute = $URL[0] === 'admin' ? true : false;

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



function isLoggedIn() {
  return !empty($_SESSION['username']) ? true : false;
}

function isAdmin() {
  return $_SESSION['permission'] === 1 ? true : false;
}

function isUserLoggedIn() {
  return isset($_SESSION['username']) && !empty($_SESSION['username'] && isset($_SESSION['permission'])) ? true : false;
}

?>

<header>
  <div class="main__nav__container">
    <a class="header__logo__link" href="<?=ROOT?>"><img class="header__logo" src="<?=ROOT?>/assets/images/logo-white.svg" alt="Motohub logo"></a>
    <nav role="main-navigation" class="header__nav">
      <a <?=setActiveLink()?> href="<?=ROOT?>">Home</a>
      <a <?=setActiveLink('motorcycles')?> href="<?=ROOT?>/home/motorcycles">Motorcycles</a>
      <a <?=setActiveLink('contact')?> href="<?=ROOT?>/home/contact">Contact</a>
    </nav>
  </div>
  <nav role="user-navigation">
      <?php if (isLoggedIn()) { ?>
        <?php if (isAdmin()) { ?>
          <a <?=setActiveLink('dashboard')?> href="<?=ROOT?>/admin">Dashboard</a>
          <a <?=setActiveLink('pages')?> href="<?=ROOT?>/admin/pages">Pages</a>
        <?php } else { ?>
          <a <?=setActiveLink('dashboard')?> href="<?=ROOT?>/home/dashboard">Dashbaord</a>
          <a <?=setActiveLink('userSettings')?> href="<?=ROOT?>/home/userSettings">Settings</a>
        <?php } ?>
        <a href="<?=ROOT?>/auth/logout">Logout</a>
      <?php } else { ?>
        <?php if ($isAdminRoute) { ?>
          <a <?=setActiveLink('login')?> href="<?=ROOT?>/admin">Login</a>
        <?php } else { ?>
          <a <?=setActiveLink('login')?> href="<?=ROOT?>/home/login">Login</a>
        <?php } ?>
      <?php } ?>
    </nav>
</header>