<?php
require_once('../../lib/util.php');
$user = 'testuser';
$password = 'testuser';
$dbname = 'testdb';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

require_once('../../common/header.php');
?>
<?php
$min = 25;
$max = 40;
$sex = '男';
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "データベース{$dbname}に接続しました。";
  $sql = "SELECT * FROM member " . 
          " WHERE age >= :min AND age <= :max AND sex = :sex";
  $sql2 = <<< EOS
      SELECT * FROM member
      WHERE age >= :min AND age <= :max AND sex = :sex
EOS;
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':min', $min, PDO::PARAM_INT);
  $stm->bindValue(':max', $max, PDO::PARAM_INT);
  $stm->bindValue(':sex', $sex, PDO::PARAM_STR);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  
  echo "<table>";
  echo "<thead><tr>";
  echo "<th>ID</th>";
  echo "<th>名前</th>";
  echo "<th>年齢</th>";
  echo "<th>性別</th>";
  echo "</tr></thead>";
  echo "<tbody>";
  foreach ($result as $row) {
    echo "<tr>";
    echo "<td>", h($row['id']), "</td>";
    echo "<td>", h($row['name']), "</td>";
    echo "<td>", h($row['age']), "</td>";
    echo "<td>", h($row['sex']), "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} catch (Exception $e) {
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}
