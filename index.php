<?php
include_once 'sql_connection.php';
session_start();
if ($_GET['action'] == 'logout') {
    $_SESSION['loggedin'] = 0;
    session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.hotwebsitetemplates.net
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hospital Management </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style type="text/css" title="currentStyle" >
            @import "css/demo_page.css";
            @import "css/demo_table.css";
            @import "css/style.css";
        </style>
        <!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/droid_sans_400-droid_sans_700.font.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

        <!-- CuFon ends -->
    </head>
    <body>
        <div class="main">
            <div style="display: none" id="userID"><?php echo $_SESSION['userid'] ?></div>
            <div class="header">
                <div class="header_resize">
                    <div class="logo">	
                        <h1><a href="/hospital/"><span>Hospital</span>Mgmt<span>System</span></a></h1>
                    </div>
                    <div class="menu_nav">
                        <ul>
                            <?php
                            include "menubar.php";
                            ?>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    <img src="images/hbg_img.jpg" width="967" height="199" alt="image" class="hbg_img" />
                    <div class="clr"></div>
                </div>
            </div>
            
            <div class="content">
                <div class="content_resize">
                    <!--      <div class="mainbar">-->
                    <div class="article">
                        <h2>&nbsp;</h2>
                    </div>
                    <div id="mainbody" class="article">
                        <?php
                        if ($_GET['action'] && $_SESSION['loggedin'])
                            if ($_GET['action'] == 'loginform') {
                                echo "<h3><center>You are already Logged In</center></h3>";
                            } else {
                                if ($_GET['action'] == 'view')
                                    echo "<script>ShowUserDetails($('#userID').html());</script>";
                                include 'include/' . $_GET['action'] . '.php';
                            }
                        elseif ($_GET['action'] == 'loginform')
                            include 'include/loginform.php';
                        else
                            include 'include/home.php';
                        ?>
                    </div>
                    <!--      </div>-->
                    <!--      <div class="sidebar">
                            <div class="gadget">
                              <h2 class="star">Links</h2><div class="clr"></div>
                              <ul class="sb_menu">
                                <li><a href="#">Home</a></li>
                                
                              </ul>
                            </div>
                          </div>-->
                    <div class="clr"></div>
                </div>
            </div>


            <div class="footer">
                <div class="footer_resize">
                    <p class="lf">&copy; Copyright <a href="#">Ramesh</a>. <span>Design by <a href="#" title="Designer's name"><?php echo $_SESSION['username']; ?></a></span></p>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </body>
</html>
