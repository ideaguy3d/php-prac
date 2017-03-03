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

if ($_POST) {
    $name = array('julius', 'hernandez', 'alvarado');
    $isKnown = false;

    foreach ($name as $key => $value) {
        if ($value == $_POST['name']) {
            $isKnown = true;
        }
    }

    if($isKnown) {
        echo 'Well Ello there '.$_POST['name'].' ^_^/';
    } else {
        echo 'Sorry. Unable to find your name in the data set';
    }
}


?> <!-- END OF: php block -->

<html lang="en">

<p>Enter your name<small> post method</small></p>


<form method="post">
    <input name="name" type="text">

    <input type="submit" value="Go!">
</form>

</html>


