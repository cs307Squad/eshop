<?php
session_start();
$makeOption = $_POST['makesub'];
$numteam = $_POST['num'];
$_SESSION['numteam'] = $numteam;
$webOptions = $_POST['webOptions'];
$_SESSION['webOptions'] = $webOptions;
$wname = $_POST['webname'];
$_SESSION['webname'] = $wname;
$wpass = $_POST['webpass'];
$_SESSION['webpass'] = $wpass;
if ($numteam === "1") {
    header("Location:createshop.php");
}
else {
    header("Location:teammates.php");
}
?>
