<?php
  if (!empty($_GET['success'])) {
    echo "<span class='success'>"."<i class='fa-solid fa-check'></i>"."&nbsp;&nbsp;".$_GET['success']."</span>";
  }
?>
<?php
  if (!empty($_GET['error'])) {
    echo "<span class='error'>"."<i class='fa-solid fa-circle-exclamation'></i>"."&nbsp;&nbsp;".$_GET['error']."</span>";
  }
?>