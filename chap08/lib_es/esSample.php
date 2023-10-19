<?php require_once('../common/header.php') ?>
<pre>
  <?php
  require_once('lib/util.php');
  $myCode = "<h2>テスト1</h2>";
  $myArray = [
    "a" => "<p>赤</p>",
    "b" => "<script>alert('hello')</script>",
  ];
  echo '$myCodeの値：', h($myCode);
  echo PHP_EOL . PHP_EOL;
  echo '$myCodeの値：', "<br>", PHP_EOL;
  foreach ($myArray as $str) {
    echo h($str), "<br>", PHP_EOL;
  }
  // print_r(es($myArray));
  ?>
</pre>
<?php require_once('../common/footer.php') ?>
