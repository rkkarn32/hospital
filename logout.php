<?php
if(!$_SESSION)
    session_start ();
$_SESSION['loggedin'] = 0;
    session_destroy();
    header("location:login.php");
?>
