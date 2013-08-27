<?php
if(!isset($_SESSION))
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
        <title>Internet Dreams</title>
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
        <!--<script type="text/javascript">
        $(function(){
                $('input').checkBox();
                $('#toggle-all').click(function(){
                $('#toggle-all').toggleClass('toggle-checked');
                $('#mainform input[type=checkbox]').checkBox('toggle');
                return false;
                });
        });
        </script>  -->
        <style type="text/css" title="currentStyle" >
            @import "css/demo_page.css";
            @import "css/demo_table.css";
            @import "css/style.css";
            @import "css/screen.css";
        </style>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/droid_sans_400-droid_sans_700.font.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript"  src="js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                //$('#viewDetail').hide();
                var Data = "task=loadalluser";
                $.ajax({
                    url:'taskprocess.php',
                    data:Data,
                    type:'POST',
                    dataType:'json',
                    cache:false,
                    success: function(output){
                        if(output[0][0] !=0){
                            oTable.fnClearTable();
                        
                            for(var i =0; i < output.length;i++){
                                oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                                    "<button type='button' class='green-button' onclick='ShowUserDetails("+output[i][0]+"); ShowPermissionList("+output[i][0]+")'>Show Details</button>",
                                    "<button type='button' class='red-button' onclick='DeleteUser("+output[i][0]+");'>Delete User</button>"
                                ]);
                            }
                        }
                    },
                    error:function(a,b,c){
                        alert("Error is "+a+b+c);
                    }
                });
            });
        </script>

        <![if !IE 7]>

        <!--  styled select box script version 1 -->
        <script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<!--        <script type="text/javascript">
            $(document).ready(function() {
                $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
            });
        </script>-->


        <![endif]>

        <!--  styled select box script version 2 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
                $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
            });
        </script>

        <!--  styled select box script version 3 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
            });
        </script>

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
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).pngFix( );
            });
        </script>
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
                                                    <form id="editForm_E" method="POST" onsubmit="return UpdateRecord()">
                                                        <?php include 'include/editrecord.php'; ?>
                                                        <div class="displaySection" id="editButton" align="center" class="displaySection">
                                                            <button class="blue-button" id="submit_E" type="submit" > Update </button>
                                                            <button class="blue-button" type="reset" id="cancel_E" onclick="CancelUpdate()"> Cancel </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div><span></span></div>

                                            <div id="searchRecord" class="displayBox">
                                                <div class="header_black" >Search Record</div>
                                                <div class="detailDispaly">
                                                    <form id="searchForm" method="POST" onsubmit="return SearchRecord();" action="test.php">
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
                                                <div class="header_black" >List Of Users</div>
                                                <div id="demo">
                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="example" class="display">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-header-repeat"><a id="" >SN</a> </th>
                                                                <th class="table-header-repeat line-left minwidth-1"><a href="">Name</a></th>
                                                                <th class="table-header-repeat line-left"><a href="">Role Type </a></th>
                                                                <th class="table-header-repeat line-left"><a href="">Account Type </a></th>
                                                                <th class="table-header-repeat line-left"><a href="">View Detail </a></th>
                                                                <th class="table-header-repeat line-left"><a href="">Delete User </a></th>
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