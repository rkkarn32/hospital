<?php

include_once 'sql_connection.php';
$action = $_GET['action'];
if ($action == '')
    $activeHome = "active";
if ($action == 'view')
    $activeProfile = "active";
if ($action == 'memberdetail')
    $activeViewMember = "active";
if ($action == 'createaccount')
    $activeCreateAccount = "active";
if ($action == 'logout')
    $activeLogOut = "active";
if ($action == 'loginform')
    $activeLogin = 'active';
if($action == 'report')
    $activeReport = 'active';

echo "<li class='$activeHome'><a href='index.php?action=home'>Home</a></li>";
if ($_SESSION['loggedin']) {

    $class = $action == "viewprofile" ? "class='selected'" : "class=''";
    echo"<li class='$activeProfile'><a href = 'index.php?action=view' title ='View Your Profile'>Profile</a></li>";
    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$retrieveData))
        echo"<li class='$activeViewMember'><a href = 'index.php?action=memberdetail' title = 'Search Users'>Search</a></li>";
    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$reportData))
        echo"<li class='$activeReport'><a href = 'index.php?action=report' title = 'Print Record'>Report</a></li>";
    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$createUser))
        echo"<li class='$activeCreateAccount'><a href = 'index.php?action=createaccount' title = 'Create New Accuont'>Add Account</a></li>";
    echo"<li class='$activeLogOut'><a href = 'index.php?action=logout' title = 'Click to LogOut'>LOGOUT</a></li>";
}
else
    echo"<li class='$activeLogin'><a href = 'login.php' title = 'Member bank login!'>LOGIN</a></li>";
?>