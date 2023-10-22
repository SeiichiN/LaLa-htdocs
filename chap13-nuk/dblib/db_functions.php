<?php
function db_connect(): mixed
{
  $user = "testuser";
  $password = "testuser";
  $dbname = "testdb";
  $host = "localhost:3306";
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

  try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $e) {
    $errors[] = "データベースに接続できません。";
    $errors[] = $e->getMessage();
    print_error($errors);
  }
  return $pdo;
}

function get_last_id(): int
{
  $sql = "SELECT max(id) FROM member";
  $result = 0;
  $pdo = db_connect();
  try {
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = (int)$stm->fetchColumn();
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function select_all(string $sql): mixed
{
  $result = null;
  $pdo = db_connect();
  try {
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function find_by_word(string $word): mixed
{
  $result = null;
  $pdo = db_connect();
  $sql = "SELECT * FROM member WHERE name LIKE :name";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', "%" . $word . "%", PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function find_by_age(int $age): mixed
{
  if ($age === 40) {
    $age2 = $age + 100;
  } else {
    $age2 = $age + 10;
  }
  $result = null;
  $pdo = db_connect();
  $sql = "SELECT * FROM member WHERE age >= :age1 AND age < :age2";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':age1', $age, PDO::PARAM_INT);
    $stm->bindValue(':age2', $age2, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function find_by_sex(string $sex): mixed
{
  $sex = ($sex ===  "m") ? "男" : "女";
  $result = null;
  $pdo = db_connect();
  $sql = "SELECT * FROM member WHERE sex = :sex";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':sex', $sex, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function find_by_sex_age(string $sex, int $age): mixed
{
  if ($age === 40) {
    $age2 = $age + 100;
  } else {
    $age2 = $age + 10;
  }
  $sex = ($sex ===  "m") ? "男" : "女";

  $result = null;
  $pdo = db_connect();
  $sql =  "SELECT * FROM member WHERE sex = :sex AND " .
    " age >= :age1 AND age < :age2";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':sex', $sex, PDO::PARAM_STR);
    $stm->bindValue(':age1', $age, PDO::PARAM_INT);
    $stm->bindValue(':age2', $age2, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function find_by_id(int $id): mixed
{
  $result = null;
  $pdo = db_connect();
  $sql = "SELECT * FROM member WHERE id = :id";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return $result;
}

function update_done(array $person): bool
{
  $result = 0;
  $pdo = db_connect();
  $sql = "UPDATE member " .
    " SET name = :name, age = :age, sex = :sex " .
    " WHERE id = :id";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', $person['name'], PDO::PARAM_STR);
    $stm->bindValue(':age', $person['age'], PDO::PARAM_INT);
    $stm->bindValue(':sex', $person['sex'], PDO::PARAM_STR);
    $stm->bindValue(':id', $person['id'], PDO::PARAM_INT);
    $result = $stm->execute();
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  if ($result > 0) {
    return true;
  }
  return false;
}

function insert_data(array $person): bool
{
  $result = false;
  $pdo = db_connect();
  $sql = "INSERT INTO member " .
    " (name, age, sex) VALUES (:name, :age, :sex)";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name', $person['name'], PDO::PARAM_STR);
    $stm->bindValue(':age', $person['age'], PDO::PARAM_INT);
    $stm->bindValue(':sex', $person['sex'], PDO::PARAM_STR);
    $stm->execute();
    return true;
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return false;
}

function delete_data(int $id): bool
{
  $pdo = db_connect();
  $sql = "DELETE FROM member WHERE id = :id";
  try {
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    return true;
  } catch (Exception $e) {
    $errors[] = "エラーがありました。";
    $errors[] = $e->getMessage();
    print_error($errors);
  } finally {
    $pdo = null;
  }
  return false;
}
