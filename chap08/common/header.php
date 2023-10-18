<?php
if (!isset($title)) {
    $title = "PHPのお勉強";
}
if (!isset($h1)) {
    $h1 = "PHP";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <header>
    <h1><?php echo $h1; ?></h1>
  </header>
