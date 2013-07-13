<?php session_start();
if($_SESSION['loggedin'])
{
    $action = $_GET['action'];
    $class= $action == "viewprofile"?"class='selected'":"class=''";
    echo'<li><a href = "index.php?action=profile" title = "View Your Profile" >Profile</a></li>';
    echo'<li><a href = "index.php?action=createaccount" title = "Create New Accuont">Create Account</a></li>';
    echo'<li><a href = "index.php?action=logout" title = "Click to LogOut">LOGOUT!</a></li>';
}
else
	echo'<li><a href = "index.php?action=loginform" title = "Member bank login!">LOGIN</a></li>';
?>