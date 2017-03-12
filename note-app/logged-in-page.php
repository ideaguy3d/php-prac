<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/10/2017
 * Time: 12:25 AM
 */

session_start();

if (array_key_exists("id", $_COOKIE) && $_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
}

if (array_key_exists("id", $_SESSION) && $_SESSION['id']) {
    include('connection.php');
    $jSessionId = mysqli_real_escape_string($link, $_SESSION['id']);
    $email = 'user1@mail.com';
    $query = 'select notes from users where email="' . $email . '" limit 1';
    $row = mysqli_fetch_array(mysqli_query($link, $query));
    $notesContent = $row['notes'];
} else {
    header("Location: index.php");
    // echo 'You are not supposed to be here';
}

include('header.php');
?>
<br>
<div class="container" data-ng-controller="CoreCtrl as coreCtrl">
    <h1 class="text-center">Take some notes:</h1>
    <h6 class="text-center">Did you know 2+2*4/16+32.5 = {{ 2+2*4/16+32.5 }} ?</h6>
    <textarea name="notes" id="notes" class="form-control" cols="15" rows="20"
              ng-model="coreCtrl.notes">
    </textarea>
</div>


<?php include('footer.php'); ?>
<?php include('angular-app.php') ?>
<?php include('doc-close.php') ?>


