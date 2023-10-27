<?php
function pre_dump($data) {
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
}

function gotoUrl(string $url, array $data = null): void
{ ?>
  <form method="post" action="<?= $url; ?>">
    <ul>
      <li><input type="submit" value="もどる"></li>
    </ul>
  </form>
<?php
}

function print_error($errors)
{
  echo '<ol class="error">';
  foreach ($errors as $value) {
    echo "<li>{$value}</li>";
  }
  echo '</ol>';
}

function h(string $data)
{
  return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function cken_check(array|string $data): void
{
  if (!cken($data)) {
    $err = "Encoding Error! The expected encoding is UTF-8";
    exit($err);
  }
}

function cken(array|string $data): bool
{
  if (phpversion() >= "7.2.0") {
    return mb_check_encoding($data);
  } else {
    if (is_array($data)) {
      return cken_old($data);
    } else {
      return mb_check_encoding($data);
    }
  }
}

// php7.2.0より前のバージョン用
// $dataがUTF-8ならば、true
// $dataがUTF-8でないなら、false
function cken_old(array $data): bool
{
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $value = implode("", $value);
    }
    if (!mb_check_encoding($value)) {
      $result = false;
      break;
    }
  }
  return $result;
}

/**
 * POSTから値を受け取る関数
 * $subject -- POSTから受け取る変数名を文字列で指定する
 *             ex. 'price'
 * &$errors -- エラーがあったときにそのエラーメッセージを格納する配列
 *             ex. $errors = array()
 * $cond -- $$subjectが正しい値であるかを判定する関数
 *             ex. function ($arg) { return ctype_digit($arg); }
 * $errMsg -- エラーメッセージを準備しておく連想配列
 *            $errMsg['bad_data'] , $errMsg['no_data'] の2種類
 *             ex. $errMsg = ['bad_data' => '整数で入力してね', 'no_data' => '未入力だよ']
 */
function getFromPost(string $subject, array &$errors, callable $cond, array $errMsg)
{
  $$subject = "";
  if (isset($_POST[$subject])) {
    $$subject = $_POST[$subject];
    if ($cond($$subject)) {;
    } else {
      $errors[] = $errMsg['bad_data'];
    }
  } else {
    $errMsg['no_data'];
  }
  return $$subject;
}
