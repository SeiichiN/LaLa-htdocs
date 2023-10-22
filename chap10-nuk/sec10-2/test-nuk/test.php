<?php
session_start();
require_once('../../lib/util.php');

if (isset($_SESSION['id'])) {
  echo $_SESSION['id'], "<br>";
} else {
  echo 'empty<br>';
}
pre_dump($_SESSION);
