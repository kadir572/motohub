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

?>

<header>
  <div class="header__container">
    <a class="header__logo" href="<?=ROOT?>">MotoHub</a>
    <div class="mode-switch">Icon</div>
    <nav class="header__nav">
      <a <?= setActiveLink() ?> href="<?=ROOT?>">Home</a><a <?= setActiveLink('motorcycles') ?> href="<?=ROOT?>/home/motorcycles">Motorcycles<a <?= setActiveLink('contact') ?> href="<?=ROOT?>/home/contact">Contact</a>
    </nav>
  </div>
</header>