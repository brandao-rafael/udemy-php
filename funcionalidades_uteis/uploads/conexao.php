<?php

$hostname = "localhost";
$dataBase = "uploads";
$user = "root";
$password ="";

$mysqli = new mysqli($hostname, $user, $password,  $dataBase);
if ($mysqli->connect_errno) {
  echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}