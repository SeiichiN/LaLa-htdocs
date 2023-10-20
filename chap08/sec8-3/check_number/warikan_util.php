<?php
function getGoukeiFromPost(&$errors) {
  $goukei = "";
  if (isset($_POST['goukei'])) {
    $goukei = $_POST['goukei'];
    if (!ctype_digit($goukei)) {
      $errors[] = "合計金額を整数で入力してください。";
    }
  } else {
    $errors[] = "合計金額が未設定";
  }
  return $goukei;
}

function getNinzuFromPost(&$errors) {
  $ninzu = "";
  if (isset($_POST['ninzu'])) {
    $ninzu = $_POST['ninzu'];
    if (!ctype_digit($ninzu)) {
      $errors[] = "人数を整数で入力してください。";
    }
  } else {
    $errors[] = "人数が未設定";
  }
  return $ninzu;
}