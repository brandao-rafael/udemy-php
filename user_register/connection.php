<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "crud_clientes";

$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
  die("falha na conexão com o banco de dados");
}