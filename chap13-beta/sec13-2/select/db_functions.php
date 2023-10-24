<?php

function connect()
{
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
    echo '接続エラー: ';
    echo $e->getMessage();
    return null;
  }
  return $pdo;
}

function find_all()
{
  $result = null;
  $pdo = connect();
  try {
    $sql = "SELECT * FROM member";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  return $result;
}

function find_by_age($age)
{
  $result = null;
  $pdo = connect();
  try {
    $sql = <<< EOS
      SELECT id, name, age, sex FROM member
      WHERE age >= :min and age < :max
EOS;
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':min', $age['min'], PDO::PARAM_INT);
    $stm->bindValue(':max', $age['max'], PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  return $result;
}

function find_by_sex($sex)
{
  $gender = ($sex === 'm') ? '男' : '女';
  $result = null;
  $pdo = connect();
  try {
    $sql = <<< EOS
      SELECT id, name, age, sex FROM member
      WHERE sex = :sex
EOS;
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':sex', $gender, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  return $result;
}

function find_by_age_sex($age, $sex)
{
  $gender = ($sex === 'm') ? '男' : '女';
  $result = null;
  $pdo = connect();
  try {
    $sql = <<< EOS
      SELECT id, name, age, sex FROM member
      WHERE age >= :min and age < :max and sex = :sex
EOS;
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':min', $age['min'], PDO::PARAM_INT);
    $stm->bindValue(':max', $age['max'], PDO::PARAM_INT);
    $stm->bindValue(':sex', $gender, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  return $result;
}

function find_by_word($search)
{
  $result = null;
  $pdo = connect();
  try {
    $sql = <<< EOS
      SELECT id, name, age, sex FROM member
      WHERE name LIKE :name
EOS;
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', "%" . $search . "%", PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  return $result;
}
