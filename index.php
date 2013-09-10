<?php
if (!$_SESSION)
    session_start();
if (!$_SESSION['loggedin'])
    header("location:login.php");
header("location:profile.php");
include_once 'taskprocess.php';
?>