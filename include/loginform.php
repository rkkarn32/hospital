<?php session_start();
    if($_SESSION['loggedin']){
        echo "<script>window.location='index.php'";
        die();
    }
?>
<center>
<div class="login">
    <form class="login" name="loginForm" id="loginForm" method="POST" onsubmit="return Login()?true: false;">
        <table id="loginTable">
            <tr>
                <th><label class="loginLabel" for="username" >User Name: </label></th>
                <th><input name="username" id="username" type="text" tabindex="11" /></th>
            </tr>
            <tr>
                <th><label class="loginLabel" for="password">Password: </label></th>
                <th><input type="password" name="password" id="password" tabindex="12"/></th>
            </tr>
            <tr>
                <th><input type="reset" tabindex="13"></th>
                <th><button type="submit" tabindex="14">Login</button><th>
            </tr>
        </table>
    </form>
</div>
</center>