<?php
if (!$_SESSION)
    session_start();
if (!$_SESSION['loggedin'])
    header("location:login.php");
include_once 'taskprocess.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Hospital Management</title>
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
        <!--[if IE]>
        <link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
        <![endif]-->

        <!--  jquery core -->
        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

        <!--  checkbox styling script -->
        <script src="js/jquery/ui.core.js" type="text/javascript"></script>
        <script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
        <style type="text/css" title="currentStyle" >
            @import "css/demo_page.css";
            @import "css/demo_table.css";
            @import "css/style.css";
        </style>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/droid_sans_400-droid_sans_700.font.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript"  src="js/jquery.dataTables.js"></script>



        <!--  styled select box script version 1 -->
        <script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
            });
        </script>

        <!--  styled select box script version 2 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>


        <!--  styled select box script version 3 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>

        <!--  styled file upload script --> 
        <script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $("input.file_1").filestyle({ 
                    image: "images/forms/choose-file.gif",
                    imageheight : 21,
                    imagewidth : 78,
                    width : 310
                });
            });
        </script>

        <!-- Custom jquery scripts -->
        <script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

        <!-- Tooltips -->
        <script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('a.info-tooltip ').tooltip({
                    track: true,
                    delay: 0,
                    fixPNG: true, 
                    showURL: false,
                    showBody: " - ",
                    top: -35,
                    left: 5
                });
            });
        </script> 


        <!--  date picker script -->
        <link rel="stylesheet" href="css/datePicker.css" type="text/css" />
        <script src="js/jquery/date.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
            $(function()
            {

                // initialise the "Select date" link
                $('#date-pick')
                .datePicker(
                // associate the link with a date picker
                {
                    createButton:false,
                    startDate:'01/01/2005',
                    endDate:'31/12/2020'
                }
            ).bind(
                // when the link is clicked display the date picker
                'click',
                function()
                {
                    updateSelects($(this).dpGetSelected()[0]);
                    $(this).dpDisplay();
                    return false;
                }
            ).bind(
                // when a date is selected update the SELECTs
                'dateSelected',
                function(e, selectedDate, $td, state)
                {
                    updateSelects(selectedDate);
                }
            ).bind(
                'dpClosed',
                function(e, selected)
                {
                    updateSelects(selected[0]);
                }
            );
	
                var updateSelects = function (selectedDate)
                {
                    var selectedDate = new Date(selectedDate);
                    $('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
                    $('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
                    $('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
                }
                // listen for when the selects are changed and update the picker
                $('#d, #m, #y')
                .bind(
                'change',
                function()
                {
                    var d = new Date(
                    $('#y').val(),
                    $('#m').val()-1,
                    $('#d').val()
                );
                    $('#date-pick').dpSetSelected(d.asString());
                }
            );

                // default the position of the selects to today
                var today = new Date();
                updateSelects(today.getTime());

                // and update the datePicker to reflect it...
                $('#d').trigger('change');
            });
        </script>

        <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
        <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<!--        <script type="text/javascript">
            $(document).ready(function(){
                $(document).pngFix( );
            });
        </script>-->
    </head>
    <body> 

        <div style="display: none" id="userID"><?php echo $_SESSION['userid'] ?></div>

        <!-- End: page-top -->
        <!-- End: page-top-outer -->

        <div class="clear">&nbsp;</div>

        <!--  start nav-outer-repeat................................................................................................. START -->
        <div class="nav-outer-repeat"> 
            <!--  start nav-outer -->
            <div class="nav-outer"> 

                <!-- start nav-right -->
                <div id="nav-right">

                    <div class="nav-divider">&nbsp;</div>
                    <div class="showhide-account"><img src="images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></div>
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
                    echo '<ul class="select">
                        <li><a href="index.php"><b>Home</b></a>
                        </li>
                    </ul>
                    <div class="nav-divider">&nbsp;</div>';

                    echo'<ul class="current">
                        <li><a href="profile.php"><b>Profile</b></a>
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
                        echo'<ul class="select">
                        <li><a href="adduser.php"><b>Add_Staff </b></a>
                        </li>
                        </ul>';
                        ?>

                    <div class="clear"></div>
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
                <div id="page-heading">
                    <h1>User List </h1>
                </div>
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
                                <script>
                                    
                                    function ShowProfileView(){
                                        $('#profileView').show();
                                        $('#changeUsername').hide();
                                        $('#changePassword').hide();
                                    }
                                    function ShowChangeUserName(){
                                        $('#profileView').hide();
                                        $('#changeUsername').show();
                                        $('#changePassword').hide();
                                    }
                                    function ShowChangePassword(){
                                        $('#profileView').hide();
                                        $('#changeUsername').hide();
                                        $('#changePassword').show();
                                    }
                                </script>
                                <script>ShowUserDetails($('#userID').html());</script>
                                <div id="table-content">
                                    <div id="profileView">
                                        <?php include_once 'include/view.php'; ?>
                                        <center>
                                            <table>
                                                <tr>
                                                    <td><button type="button" onclick="ShowChangeUserName();" >Change Username</button></td>
                                                    <td><button type="button" onclick="ShowChangePassword();" >Change Password</button></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </div>
                                    <center>
                                        <div id="changeUsername" style="display: none" >
                                            <form id="changeUsernameForm" method="POST" onsubmit="return ChangeUsername();">
                                                <table align="center">
                                                    <tr>
                                                        <td><label for="">New Username: </label></td>
                                                        <td><input type="text" id="newUsername" name="newUsername" maxlength="50" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><button type="submit">Change Username</button></td>
                                                        <td><button type="button" onclick="ShowProfileView();">Cancel</button></td>
                                                    </tr>
                                                </table>
                                            </form>

                                        </div>
                                        <div id="changePassword" style="display: none">
                                            <form id="changePassword" method="POST" onsubmit="return ChangePassword();">
                                                <table>
                                                    <tr>
                                                        <td>New Password</td>
                                                        <td><input type="password" name="newPassword" id="newPassword" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Confirm Password </td>
                                                        <td><input type="password" name="confirmPassword" id="confirmPassword" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><button type="submit">Update Password</button></td>
                                                        <td><button type="button" onclick="ShowProfileView();">Cancel</button></td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </center>
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