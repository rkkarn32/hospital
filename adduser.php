<?php
if(!isset($_SESSION))
    session_start();
if (!$_SESSION['loggedin'])
    header("location:login.php");
include_once 'taskprocess.php';
if (!$sql->HasPermission($_SESSION['userid'], PermissionByID::$createUser))
    header("location:login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hospital Management</title>
        <style type="text/css" title="currentStyle" >            
            @import "css/demo_table.css";
            @import "css/style.css";
            @import "css/screen.css";
        </style>
        <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/functions.js"></script>
    </head>
    <body> 


        <!-- End: page-top -->

        </div>
        <!-- End: page-top-outer -->

        <div class="clear">&nbsp;</div>

        <!--  start nav-outer-repeat................................................................................................. START -->
        <div class="nav-outer-repeat"> 
            <!--  start nav-outer -->
            <div class="nav-outer"> 

                <!-- start nav-right -->
                <div id="nav-right">

                    <div class="nav-divider">&nbsp;</div>
                    <a href="logout.php" id="logout"><img src="images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
                    <div class="clear">&nbsp;</div>

                    <!--  start account-content -->	
                </div>
                <!--  end account-content -->

            </div>
            <div class="nav">
                <div class="table">

                    <?php
                    echo'<ul class="select">
                        <li><a href="profile.php"><b>Home</b></a>
                        </li>
                    </ul>
                    <div class="nav-divider">&nbsp;</div>
                    ';

                    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$retrieveData))
                        echo'<ul class="select">
                            <li><a href="userdetail.php"><b>Search</b></a>
                            </li></ul>
                            <div class="nav-divider">&nbsp;</div>';
                    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$reportData))
                        echo'<ul class="select">
                        <li><a href="report.php"><b>Report</b></a>
                        </li>
                        </ul>

                        <div class="nav-divider">&nbsp;</div>';
                    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$createUser))
                        echo'<ul class="current">
                        <li><a href="adduser.php"><b>Add_Staff </b></a>
                        </li>
                        </ul>';
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <!--  start nav -->

        </div>
        <!--  start nav-outer-repeat................................................... END -->

        <div class="clear"></div>

        <!-- start content-outer ........................................................................................................................START -->
        <div id="content-outer">
            <!-- start content -->
            <div id="content">

                <!--  start page-heading -->
                <!-- end page-heading -->

                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
                    <tr>
                        <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
                        <th class="topleft"></th>
                        <td id="tbl-border-top">&nbsp;</td>
                        <th class="topright"></th>
                        <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
                    </tr>
                    <tr>
                        <td id="tbl-border-left"></td>
                        <td>
                            <!--  start content-table-inner ...................................................................... START -->
                            <div id="content-table-inner">

                                <!--  start table-content  -->
                                <div id="table-content">
                                    <div class="displayBox">
                                        <?php
                                        include_once 'include/createaccount.php';
                                        ?>
                                    </div>
                                </div>
                                <!--  end content-table  -->


                                <div class="clear"></div>

                            </div>
                            <!--  end content-table-inner ............................................END  -->
                        </td>
                        <td id="tbl-border-right"></td>
                    </tr>
                    <tr>
                        <th class="sized bottomleft"></th>
                        <td id="tbl-border-bottom">&nbsp;</td>
                        <th class="sized bottomright"></th>
                    </tr>
                </table>
                <div class="clear">&nbsp;</div>

            </div>
            <!--  end content -->
            <div class="clear">&nbsp;</div>
        </div>
        <!--  end content-outer........................................................END -->

        <div class="clear">&nbsp;</div>

        <!-- start footer -->         
        <div id="footer">
            <!--  start footer-left -->
            <div id="footer-left">

                Admin: Hospital Management <span id="spanYear"></span> <a href="">www.testing.com.np</a>. All rights reserved.</div>
            <!--  end footer-left -->
            <div class="clear">&nbsp;</div>
        </div>
        <!-- end footer -->

    </body>
</html>