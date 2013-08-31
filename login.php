<?php
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION['loggedin']))
    header("location:index.php");
//if($_SESSION['loggedin']){
//    header("location:index.php");
//}
?>
<html>
    <head><title>Hospital Management</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<script src="template/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="template/js/jquery/custom_jquery.js" type="text/javascript"></script>
<script src="template/js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript"  src="js/jquery.dataTables.js"></script>
<script src="js/functions.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).pngFix();
    });
</script>
</head>
<body id="login-bg"> 

    <!-- Start: login-holder -->
    <div id="login-holder">

        <!-- start logo -->
        <div id="logo-login">
<!--		<a href="index.html"><img src="../template/images/shared/logo.png" width="156" height="40" alt="" /></a>-->
        </div>
        <!-- end logo -->

        <div class="clear"></div>

        <!--  start loginbox ................................................................................. -->
        <div id="loginbox">

            <!--  start login-inner -->
            <div id="login-inner">
                <form id="loginForm" method="POST" onsubmit="return Login();">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Username</th>
                            <td><input type="text" name="username" class="login-inp" /></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" name="password" value="" onfocus="this.value=''" class="login-inp" /></td>
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
            <a href="" class="forgot-pwd">Forgot Password?</a>
        </div>
        <!--  end loginbox -->

        <!--  start forgotbox ................................................................................... -->
        <div id="forgotbox">
            <div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
            <!--  start forgot-inner -->
            <div id="forgot-inner">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Email address:</th>
                        <td><input type="text" value=""   class="login-inp" /></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td><input type="button" class="submit-login"  /></td>
                    </tr>
                </table>
            </div>
            <!--  end forgot-inner -->
            <div class="clear"></div>
            <a href="" class="back-login">Back to login</a>
        </div>
        <!--  end forgotbox -->

    </div>
    <!-- End: login-holder -->

        
</body>
</html>