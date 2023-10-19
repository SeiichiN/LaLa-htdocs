<?php
require_once('./lib/util.php');
$utf8_string = "こんにちは";
$sjis_string = mb_convert_encoding($utf8_string, 'SJIS-win');
var_dump($sjis_string);
if (cken($sjis_string)) {
  echo "UTF-8";
} else {
  echo "NOT";
}
echo "<br>\n";
