<?php
function connect () {
  $dbuser = 'junbiuser';
  $dbpass = 'junbiuser';
  $dbname = 'junbi';
  $host = 'localhost';
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

  try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'データベースに接続できませんでした。', $e->getMessage();
    echo 'おそらくデータベースが起動されていません。';
    exit();
  }
  return $pdo;
}

function findAll () {
  $pdo = connect();
  $sql = "SELECT id, name, password FROM account";
  try {
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo 'エラー ' . $e->getMessage();
    return null;
  }
  return $result;
}

function find_by_name (string $name) {
  $pdo = connect();
  $sql = "SELECT id, name, password FROM account" .
         " WHERE name = :name";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', $name, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo 'エラー ' . $e->getMessage();
    return null;
  }
  return $result;
}

function bad_find_by_name (string $name) {
  if ($name == null || $name == "") return null;
  $pdo = connect();
  $sql = "SELECT id, name, password FROM account" .
         " WHERE name = '{$name}'";
  try {
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo 'エラー ' . $e->getMessage();
    return null;
  }
  return $result;
}


function insert ($data) {
  $pdo = connect();
  $sql = "INSERT INTO account (name, password) VALUES (:name, :pass)";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', $data['name'], PDO::PARAM_STR);
    $stm->bindValue(':pass', $data['pass'], PDO::PARAM_STR);
    $result = $stm->execute();
    if ($result) { return true; }
  } catch (PDOException $e) {
    echo 'insert エラー ' . $e->getMessage();
  }
  return false;
}

function bad_insert ($data) {
  $pdo = connect();
  $sql = "INSERT INTO account (name, password) " .
         "VALUES ({$data['name']}, {$data['pass']})";
  try {
    $stm = $pdo->prepare($sql);
    $result = $stm->execute();
    if ($result) { return true; }
  } catch (PDOException $e) {
    echo 'insert エラー ' . $e->getMessage();
  }
  return false;
}

function disp_password ($username) {
  $pdo = connect();
  $sql = "SELECT id, name, password from account " .
         " WHERE name = :name";
  try {
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo 'disp_password エラー ' . $e->getMessage();
    return null;
  }
  return $result;
}

// 修正時刻: Sun 2023/10/08 13:15:47
