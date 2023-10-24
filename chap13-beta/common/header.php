<?php
// $h1に値が設定されていなかったら
if (!isset($h1)) {
  $h1 = "PHP";
}
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
  $cssdir = "http://{$_SERVER['SERVER_NAME']}/chap13/css";
} else if (PHP_OS === 'Linux') {
  $cssdir = "http://{$_SERVER['SERVER_NAME']}/~se-ichi/chap13-beta/css";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= $cssdir ?>/style.css">
  <link rel="stylesheet" href="<?= $cssdir ?>/tablestyle.css">
</head>

<body>
  <header>
    <div class="header-inn flex">
      <h1><?php echo $h1; ?></h1>
      <nav>
        <ul class="flex">
          <li><a href="index.php">一覧</a></li>
          <li><a href="input_data.php">新規</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="flex main-contents">