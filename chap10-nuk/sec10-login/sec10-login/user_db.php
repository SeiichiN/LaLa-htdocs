<?php

function isValidUser($id, $pass)
{
  $dbpass = getPassById($id);
  return $dbpass === $pass;
}

function getPassById(string $id): string
{
  $members = [
    'SOL001' => '1111',
    'SOL002' => '2222',
    'SOL003' => '3333',
  ];

  foreach ($members as $key => $val) {
    if ($key === $id) {
      return $val;
    }
  }
  return "";
}
