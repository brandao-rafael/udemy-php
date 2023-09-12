<?php

foreach($_POST as $key => $value) {
  echo "O " . ucfirst($key) . " é: " . $value . "<br>";
}