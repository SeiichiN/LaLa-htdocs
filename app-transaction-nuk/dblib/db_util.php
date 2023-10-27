<?php

function connect()
{
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

function find_goods_brand_stock()
{
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

function get_brand_list()
{
  $pdo = connect();
  $brand = null;
  try {
    $sql = "SELECT id, name FROM brand";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $brand = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo 'エラーがありました。';
    echo $e->getMessage();
    $brand = null;
  }
  return $brand;
}

function insert_goods_stock(array $goodsStockData): bool
{
  $pdo = connect();
  try {
    $pdo->beginTransaction();
    $sql1 = <<< EOS
      INSERT INTO goods (id, name, size, brand)
      VALUES (:id, :name, :size, :brand)
  EOS;
    $sql2 = <<< EOD
      INSERT INTO stock (goods_id, quantity)
      VALUES (:goods_id, :quantity)
  EOD;
    $insertGoods = $pdo->prepare($sql1);
    $insertStock = $pdo->prepare($sql2);
    $insertGoods->bindValue(':id', $goodsStockData['id'], PDO::PARAM_STR);
    $insertGoods->bindValue(':name', $goodsStockData['name'], PDO::PARAM_STR);
    $insertGoods->bindValue(':size', $goodsStockData['size'], PDO::PARAM_STR);
    $insertGoods->bindValue(':brand', $goodsStockData['brand'], PDO::PARAM_STR);
    $insertStock->bindValue(':goods_id', $goodsStockData['id'], PDO::PARAM_STR);
    $insertStock->bindValue(':quantity', $goodsStockData['quantity'], PDO::PARAM_INT);
    $insertGoods->execute();
    $insertStock->execute();
    $pdo->commit();
    return true;
  } catch (Exception $e) {
    $pdo->rollBack();
    echo '登録処理エラー';
    echo $e->getMessage();
  }
  return false;
}
