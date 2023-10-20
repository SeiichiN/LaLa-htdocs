<?php
require_once('lib/util.php');

$utf8_string = "こんにちは";
$sjis_string = mb_convert_encoding($utf8_string, 'SJIS-win');

if (cken($utf8_string)) {
  echo '現在の値はUTF-8です。';
} else {
  echo '現在の値はUTF-8ではありません。';
}
