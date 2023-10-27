<?php
function connect()
{
  $user = "inventoryuser";
  $password = "inventoryuser";
  $dbname = "inventory";
  $host = "localhost:3306";
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

  $pdo = null;
  try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $e) {
    echo  "エラーがありました。";
    echo  $e->getMessage();
    $pdo = null;
  }
  return $pdo;
}
