<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "crud_clientes";

$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
  die("falha na conexão com o banco de dados");
}

function date_formater($date) {
  return implode("/", array_reverse(explode("-", $date)));
}

function phone_format($phone) {
    $ddd = substr($phone, 0, 2);
    $parte1 = substr($phone, 2, 5);
    $parte2 = substr($phone, 7);
    $telefone = "($ddd) $parte1-$parte2";
  return $telefone;
}