<?php
require_once('../../lib/util.php');

$user = "testuser";
$password = "testuser";
$dbname = "testdb";
$host = "localhost:3306";
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

?>
<?php
$h1 = "レコードをとりだす";
require_once('../../common/header.php');
?>
<?php
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "データベース{$dbname}に接続しました。";
  $sql = "SELECT * FROM member";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>年齢</th>
        <th>性別</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo h($row["id"]); ?></td>
          <td><?php echo h($row['name']); ?></td>
          <td><?php echo h($row['age']); ?></td>
          <td><?php echo h($row["sex"]); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php
} catch (Exception $e) {
  $errors[] = "エラーがありました。";
  $errors[] = $e->getMessage();
  print_error($errors);
} finally {
  $pdo = null;
}
?>
<?php require_once('../../common/footer.php');
