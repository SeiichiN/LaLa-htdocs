<?php
function connect() {
  $user = 'testuser';
  $password = 'testuser';
  $dbname = 'testdb';
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
  }
  return $pdo;
}

function find_all() {
  $result = null;
  $pdo = connect();
  try {
    $sql = "SELECT * FROM member";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo 'エラーがありました。';
    echo $e->getMessage();
  }
  return $result;
}

/**
 * 新規データの登録
 * 成功: true
 * 失敗: false
 * 
 * $person == [
 *   'id' => 12,
 *   'name' => '田中治郎',
 *   'age' => 34,
 *   'sex' => '男'
 * ]
 */
function create_data(array $person) {
  $result = false;
  $pdo = connect();
  try {
    // echo "データベース{$dbname}に接続しました。";
    $sql = "INSERT INTO member (name, age, sex) " . 
            " VALUES (:name, :age, :sex)";
    $sql2 = <<< EOS
        INSERT INTO member (name, age, sex)
        VALUES (:name, :age, :sex)
  EOS;
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', $person['name'], PDO::PARAM_STR);
    $stm->bindValue(':age', $person['age'], PDO::PARAM_INT);
    $stm->bindValue(':sex', $person['sex'], PDO::PARAM_STR);
    $result = $stm->execute();
  } catch (Exception $e) {
    echo 'エラーがありました。';
    echo $e->getMessage();
  }
  return $result;
}