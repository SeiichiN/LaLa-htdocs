<?php
    $tanka = $_POST['tanka'];
    $kosu = $_POST['kosu'];
    $price = $tanka * $kosu;
    $tanka = number_format($tanka);
    $price = number_format($price);
?>
<?php
$h1 = "price";
require_once('../../common/header.php'); 
?>
  <div>
    <?php
    echo "<p class=\"notice\">単価{$tanka}円 ✕ {$kosu}個は {$price}円です。</p>";
    ?>
  </div>
<?php
require_once('../../common/footer.php');


