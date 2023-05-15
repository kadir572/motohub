<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'partials/head-core.php'; ?>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/public/contact.css">
    <title>Motohub | Contact Us</title>
  </head>
  <body>
  <?php include_once 'partials/header.php'; ?>
  <main>
    <div class="bg-img"></div>
    <h2>Contact Us</h2>
    <form action="<?=ROOT?>/home/contact?type=send" method="POST">
      <?php
      if (!empty($_GET['success'])) {
        echo "<span class='success'>"."<i class='fa-solid fa-check'></i>"."&nbsp;&nbsp;".$_GET['success']."</span>";
      }
      ?>
      <div class="form__control--radio">
        
        <label class="form__label--radio" for="pronounce__mr"><input type="radio" name="pronounce" id="pronounce__mr">&nbsp;Mr.</label>
        
        <label class="form__label--radio" for="pronounce__mrs"><input type="radio" name="pronounce" id="pronounce__mrs">&nbsp;Mrs.</label>
        
        <label class="form__label--radio" for="pronounce__ms"><input type="radio" name="pronounce" id="pronounce__ms">&nbsp;Ms.</label>
      </div>
      <div class="form__control">
        <input type="text" class="form__input" id="name" name="name" placeholder="Name">
        <label class="form__label" for="name">Name</label>
      </div>
      <div class="form__control">
        <input type="email" class="form__input" id="email" name="email" placeholder="Email">
        <label for="email" class="form__label">Email</label>
      </div>
      <div class="form__control">
        <textarea class="form__input" name="message" id="message" cols="30" rows="10" placeholder="Your message"></textarea>
        <label class="form__label" for="message">Your message</label>
      </div>
      <div class="form__control--checkbox">
      <input class="form__input--checkbox" type="checkbox" name="copy" id="copy">
        <label for="copy" class="form__label--checkbox">Get a copy</label>
      </div>
      <button class="form__submit" type="submit">Send</button>
    </form>
  </main>
  <?php include_once 'partials/footer.php'; ?>
  </body>
</html>