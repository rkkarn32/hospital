<?php
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION['loggedin']))
    header("location:index.php");
?>
<html>
    <head><title>Hospital Management</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<script src="js/jquery-1.10.2.js" type="text/javascript"></script> 
<script src="js/functions.js" type="text/javascript"></script> 
</head>
<body id="login-bg"> 

    <!-- Start: login-holder -->
    <div id="login-holder">

        <!-- start logo -->
        <div id="logo-login">
        </div>
        <!-- end logo -->

        <div class="clear"></div>

        <!--  start loginbox ................................................................................. -->
        <div id="loginbox">

            <!--  start login-inner -->
            <div id="login-inner">
                <form id="loginForm" method="POST" onSubmit="return Login();">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Username</th>
                            <td><input type="text" name="username" class="login-inp" /></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" name="password" value="" onFocus="this.value=''" class="login-inp" /></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td align="center"><input type="submit" class="submit-login"  /></td>
                        </tr>
                    </table>
                </form>
                <div id="loading" style="display: none;" >  </div>
            </div>
            <!--  end login-inner -->
            <div class="clear"></div>
            
        </div>
        

    </div>
    <!-- End: login-holder -->

        
</body>
</html>