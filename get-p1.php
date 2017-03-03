<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/2/2017
 * Time: 10:20 PM
 */

function jBreak()
{
    echo "<br><br><hr><br>";
}

$name = "Rob";

echo "Julius Alvarado ^_^/";

$myArray = array("julius", "hernandez", "alvarado");

echo "<br><br>";

print_r($myArray);

echo "<br><br>";

$langArray = array(
    "France" => "French",
    "United States" => "English",
    "Mexico" => "Spanish",
    "Germany" => "German"
);

print_r($langArray);

echo sizeof($langArray);

echo "<br><br>";

$myName = $myArray;

//-- foreach loop:
foreach ($myName as $key => $value) {
    echo "my names are " . $key . " and " . $value . "<br>";
}

jBreak();

//-- $_GET prac:
if (is_numeric($_GET['number']) && $_GET['number'] > 0
    && $_GET['number'] == round($_GET['number'], 0)
) {

    $i = 2;
    $isPrime = true;

    while ($i < $_GET['number']) {
        if ($_GET['number'] % $i == 0) {
            $isPrime = false;
        }
        $i++;
    }

    if ($isPrime) {
        echo "<strong>" . $i . " is a prime number :)</strong>";
    } else {
        echo "<strong>" . $i . " is <i>NOT</i> a prime number :(</strong>";
    }
} else if ($_GET) {
    // user submitted a val that is not a positive whole number
    echo "<p style='color: indianred'> please enter a positive whole number</p>";
}

jBreak();

//if ($_GET["name"]) echo "Well Ello " . $_GET["name"];



?> <!-- END OF: php region -->

<html lang="en">

<p>Enter a whole number!!</p>

<form action="">
    <input name="number" type="text">

    <input type="submit" value="Go!">
</form>

</html>


