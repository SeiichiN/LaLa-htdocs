<?php
require_once('../../lib/util.php');
require_once('db_functions.php');

cken_check($_POST);

$isSex = false;
$isAge = false;
$errors = [];
$word = "";
$isSearch = false;
if (isset($_POST['search'])) {
  $search = trim($_POST['search']);
  $len = mb_strlen($search);
  if ($len < 10 && $len > 0) {
    $isSearch = true;
  } else {
    $errors[] = "検索語が不正";
  }
} else {
  $errors[] = "検索語が未入力";
}

if ($isSearch) {
  $result = find_by_word($search);
}

if (!$result) {
  exit();
}

require_once('../../common/header.php');
require_once('../../common/article.php');
require_once('../../common/aside.php');
require_once('../../common/footer.php');
