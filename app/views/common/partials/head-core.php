<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link
      rel="stylesheet"
      href="https://www.unpkg.com/tailwindcss@3.1.8/src/css/preflight.css"
    />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css" />
<?php if (!empty($_SESSION['username'])) : ?>
  <script src="<?=ROOT?>/assets/js/header.js" defer type="module"></script>
<?php endif; ?>