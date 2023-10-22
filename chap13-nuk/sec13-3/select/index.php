<?php
session_start();
require_once('../../lib/util.php');

require_once('../../dblib/db_functions.php');
?>
<?php
// pre_dump($_POST);
$result = null;
$sql = "SELECT * FROM member";
if (isset($_POST['sql'])) {
  $sql = trim($_POST['sql']);
}
$result = select_all($sql);
if (isset($_POST['age'])) {
  $age = $_POST['age'];
  if (ctype_digit($age)) {
    $age = (int)$age;
    $result = find_by_age($age);
  }
}
if (isset($_POST['search'])) {
  $word = trim($_POST['search']);
  $result = find_by_word($word);
}
if (isset($_POST['sex'])) {
  $sex = $_POST['sex'];
  if (isset($_POST['age'])) {
    $age = ($_POST['age']);
    if (ctype_digit($age)) {
      $age = (int)$age;
      $result = find_by_sex_age($sex, $age);
    }
  } else {
    $result = find_by_sex($sex);
  }
}
?>
<?php
$h1 = "知人録";
require_once('../../common/header.php');
?>
<section class="flex">
  <?php if ($result !== null) : ?>
    <article class="main">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>名前</th>
            <th>年齢</th>
            <th>性別</th>
            <th class="no-border no-background-color"></th>
            <th class="no-border no-background-color"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $row) : ?>
            <tr>
              <td><?php echo h($row["id"]); ?></td>
              <td><?php echo h($row['name']); ?></td>
              <td><?php echo h($row['age']); ?></td>
              <td><?php echo h($row["sex"]); ?></td>
              <td class="no-border">
                <form method="post" action="update.php">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <input type="submit" value="編集">
                </form>
              </td>
              <td class="no-border">
                <form method="post" action="delete.php">
                  <input type="hidden" name="<?= $row['id'] ?>">
                  <input type="submit" value="削除">
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </article>
  <?php endif; ?>
  <?php require_once('aside.php'); ?>
</section>
<?php require_once('../../common/footer.php');
