<?php

define("secInDay", 86400);

// timestamp
echo time() . "<br>";

// convert to timestamp
echo strtotime("2020-02-21") . "<br>";

// distance in days
echo (time() - strtotime("2023-09-13")) / secInDay . "<br>";

// format date or show informations based on first param
echo date("D", strtotime("2023-09-13")) . "<br>";
echo date("d/m/Y", strtotime("2023-09-13")) . "<br>";

// timestamp to datetime
echo date("d/m/Y H:i", time()) . "<br>";

// sum 100 days in a date
$date = "2022-02-05";
$newDate = strtotime($date) + (secInDay*100);
echo date("d/m/Y", $newDate) . "<br>";

// subtract 100 days
$newSubDate = date("d/m/Y", strtotime($date) - (secInDay*100));
echo $newSubDate . "<br>";

// timestamp to usa format
echo date("Y-m-d", time()) . '<br>';
