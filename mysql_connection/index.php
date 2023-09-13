<?php

include("connect.php");

echo "Olá! <br>";

$query_exec = $mysqli->query('SELECT * FROM veiculos WHERE fabricante != "Peugeot" ORDER BY veiculo LIMIT 20') or die($mysqli->error);
while ($car = $query_exec->fetch_assoc()) {
  echo $car['modelo'] . " - " . $car['fabricante'] . "<br>";
}