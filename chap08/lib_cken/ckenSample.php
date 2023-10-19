<?php
require_once('./lib/util.php');
$utf8_string = "こんにちは";
$sjis_string = mb_convert_encoding($utf8_string, 'Shift_JIS');
if (php_ver_check()) {
  $result = mb_check_encoding($sjis_string);
} else {
  $result = cken([$sjis_string]);
}
if ($result) {
  echo "UTF-8";
} else {
  echo "NOT";
}
echo "<br>\n";

$result1 = php_ver_check();
$result2 = mb_check_encoding($utf8_string);
var_dump($result2);
