<?php
if (!$_SESSION)
    session_start();
if (!$_SESSION['loggedin'])
    header("location:login.php");
include_once 'taskprocess.php';
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>Welcome Message</title>
        <link href="css1/bootstrap.css" rel="stylesheet">    
        <script src="css1/jquery.js"></script>
        <script src="css1/bootstrap-modal.js"></script>    
        <script type="text/javascript">
            $(window).load(function(){
                $('#myModal').modal('show');
            });
            function BackToHomePage(){
                window.location="profile.php";
            }
        </script>
    </head>   
    <body>
        <div id="name" style="display: none"><?php $_POST['name'] ?></div>
        <?php
        $a = 0;
        if ($a == 0) {
            ?>
            <div class="modal fade" id="myModal">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Welcome: <?php echo $_GET['name']; ?></h3>
                </div>
                <div class="modal-body">
                    <p>Its Your First Login, Please Update Your username and password</p>
                </div>
                <div class="modal-footer">
                    <!--                    <button class="btn" data-dismiss="modal">Close</button>-->
                    <button class="btn btn-primary" onclick="BackToHomePage();">Close</button>
                </div>
            </div>
            <?php
        }
        ?>   
    </body>
</html>