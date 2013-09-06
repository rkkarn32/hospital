<?php
if (!isset($_SESSION))
    session_start();
if (!$_SESSION['loggedin'])
    header("location:login.php");
include_once 'taskprocess.php';
if (!$sql->HasPermission($_SESSION['userid'], PermissionByID::$retrieveData))
    header("location:profile.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Hospital Management</title>
        <style type="text/css" title="currentStyle" >            
            @import "css/demo_table.css";
            @import "css/style.css";
            @import "css/screen.css";
        </style>
        <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script>
            $(document).ready(function(){
                oTable = $('#example').dataTable({
                });
                HideEditDetail();
                LoadAllUser();
            });
        </script>
        <script type="text/javascript"  src="js/jquery.dataTables.js"></script>
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
                        echo'<ul class="current">
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
                        echo'<ul class="select">
                        <li><a href="adduser.php"><b>Add_Staff </b></a>
                        </li>
                        </ul>';
                    ?>
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


                                        <!--  end message-green -->


                                        <!--  start product-table ..................................................................................... -->

                                        <div id="container" class="container">
                                            <div class="displayBox" id="viewDetail" style="display: none">
                                                <div class="header_black" >User Detail</div>
                                                <div class="detailDispaly">
                                                    <?php
                                                    include_once 'include/view.php';
                                                    if ($sql->HasPermission($_SESSION['userid'], PermissionByID::$editInfo)) {
                                                        echo '<div class="displaySection"> <center><button class="red-button" id="editButton" name="editButton">Edit Data</button></center></div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div id="editDetail" style="display: nones" class="displayBox">
                                                <div class="header_black" >Edit Record</div>
                                                <div class="detailDispaly">
                                                    <form id="editForm_E" method="POST" onSubmit="return UpdateRecord()">
                                                        <?php include 'include/editrecord.php'; ?>
                                                        <div class="displaySection" id="editButton" align="center" class="displaySection">
                                                            <button class="blue-button" id="submit_E" type="submit" > Update </button>
                                                            <button class="blue-button" type="reset" id="cancel_E" onClick="CancelUpdate()"> Cancel </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div><span></span></div>

                                            <div id="searchRecord" class="displayBox">
                                                <div class="header_black" >Search Record</div>
                                                <div class="detailDispaly">
                                                    <form id="searchForm" method="POST" onSubmit="return SearchRecord();" action="test.php">
                                                        <div class="displaySection">
                                                            <?php include_once 'include/searchform.php'; ?>
                                                        </div>
                                                        <div id="searchButton" align="center" class="displaySection">
                                                            <button class="blue-button" type="submit">Search Result</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="displayBox">
                                                <div class="header_black" >User List</div>
                                                <div id="demo">
                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="example" class="display">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-header-repeat"><a id="" >SN</a> </th>
                                                                <th class="table-header-repeat line-left minwidth-1"><a >Name</a></th>
                                                                <th class="table-header-repeat line-left"><a >Role Type </a></th>
                                                                <th class="table-header-repeat line-left"><a >Account Type </a></th>
                                                                <th class="table-header-repeat line-left"><a >View Detail </a></th>
                                                                <th class="table-header-repeat line-left"><a >Delete User </a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                    <!--  end product-table................................... --> 
                                                </div>
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

                    Admin: Hospital Management <span id="spanYear"></span> <a href="">www.testing.com</a>. All rights reserved.</div>
                <!--  end footer-left -->
                <div class="clear">&nbsp;</div>
            </div>
            <!-- end footer -->

    </body>
</html>