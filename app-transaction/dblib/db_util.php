<?php

function connect() {
  $user = 'inventoryuser';
  $password = 'inventoryuser';
  $dbname = 'inventory';
  $host = 'localhost:3306';
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  $pdo = null;
  try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $e) {
    echo '接続エラー';
    echo $e->getMessage();
    $pdo = null;
  } 
  return $pdo;
}

function find_goods_brand_stock() {
  $pdo = connect();
  $result = null;
  try {
    $sql = <<< EOS
      SELECT
        g.id as goods_id,
        g.name as goods_name,
        g.size as size,
        b.name as brand_name,
        s.quantity as quantity
      FROM goods g
        JOIN brand b
        ON g.brand = b.id
          JOIN stock s
          ON g.id = s.goods_id
      ORDER BY goods_name
  EOS;
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo 'エラーがありました';
    echo $e->getMessage();
    $result = null;
  }
  return $result;
}