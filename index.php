<?php

$name = "Rob";

echo "Julius Alvarado ^_^";

$myArray = array("julius", "hernandez", "alvarado");

echo "<br><br>";

print_r($myArray);

echo "<br><br>";

$langArray = array(
    "France" => "French",
    "United States" => "English",
    "Germany" => "German"
);

print_r($langArray);

echo sizeof($langArray);

echo "<br><br>";

$myName = $myArray;

foreach ($myName as $key => $value) {
    echo "my names are ".$key." and ".$value."<br>";
}

?>

<html>

</html>
