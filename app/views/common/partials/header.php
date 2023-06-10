<?php
_SessionHandler::checkSessionActivity();

$URL = Utility::splitUrl();
$isAdminRoute = $URL[0] === 'admin' ? true : false;

function setActiveLink($page = '') {
  $URL = Utility::splitUrl();
  if ($URL[0] === 'admin') return;
  
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
    <nav role="user-navigation">
      <?php if (!isLoggedIn() && !$isAdminRoute) { ?>
        <a <?=setActiveLink('login')?> href="<?=ROOT?>/home/login"><i class="fa-solid fa-user"></i>Login</a>
      <?php } elseif (isLoggedIn()) { ?>
        <div class="user__actions">
        <button class="user__btn"><i class="fa-solid fa-user"></i><?=$_SESSION['username']?><i class="fa-solid fa-chevron-down"></i></button>
        <div class="user__dropdown">
          <?php if (isAdmin()) { ?>
            <a href="<?=ROOT?>/admin"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="<?=ROOT?>/admin/pages"><i class="fa-solid fa-gear"></i>Pages</a>
          <?php } else { ?>
            <a href="<?=ROOT?>/user"><i class="fa-solid fa-gauge"></i>Dashbaord</a>
            <a href="<?=ROOT?>/user/settings"><i class="fa-solid fa-gear"></i>Settings</a>
          <?php } ?>
          <a href="<?=ROOT?>/auth/logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
        </div>
      <?php } ?>
    </nav>
    <div class="mobile__nav__btn mobile__nav__btn--open"><i class="fa-solid fa-bars"></i></div>
    
  </div>
  <div class="mobile__menu">
    <div class="mobile__nav__btn mobile__nav__btn--close"><i class="fa-solid fa-x"></i>
    </div>
    <div class="mobile__menu__container">
        <nav role="main-navigation--mobile">
          <span><i class="fa-solid fa-location-arrow"></i>Navigation</span>
          <a <?=setActiveLink()?> href="<?=ROOT?>"><i class="fa-solid fa-house"></i>Home</a>
          <a <?=setActiveLink('motorcycles')?> href="<?=ROOT?>/home/motorcycles"><i class="fa-solid fa-motorcycle"></i>Motorcycles</a>
          <a <?=setActiveLink('contact')?> href="<?=ROOT?>/home/contact"><i class="fa-solid fa-address-book"></i>Contact</a>
        </nav>
        <nav role="user-navigation--mobile">
          <?php if (!isLoggedIn() && !$isAdminRoute) { ?>
            <a <?=setActiveLink('login')?> href="<?=ROOT?>/home/login"><i class="fa-solid fa-user"></i>Login</a>
          <?php } elseif (isLoggedIn()) { ?>
            <span><i class="fa-solid fa-user"></i><?=$_SESSION['username']?></span>
            <?php if (isAdmin()) { ?>
            <a href="<?=ROOT?>/admin"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="<?=ROOT?>/admin/pages"><i class="fa-solid fa-gear"></i>Pages</a>
          <?php } else { ?>
            <a href="<?=ROOT?>/user"><i class="fa-solid fa-gauge"></i>Dashbaord</a>
            <a href="<?=ROOT?>/user/settings"><i class="fa-solid fa-gear"></i>Settings</a>
          <?php } ?>
          <a href="<?=ROOT?>/auth/logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
          <?php } ?>
        </nav>
      </div>
    </div>
</header>