<?php

foreach($_GET as $key => $value) {
  echo "O " . ucfirst($key) . " é: " . $value . "<br>";
}