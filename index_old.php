<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.hotwebsitetemplates.net
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Hospital Management </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/droid_sans_400-droid_sans_700.font.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<!-- CuFon ends -->
</head>
    <body >
<div class="main">

  <div class="header">
    <div class="header_resize">
      <div class="logo">	
          <h1><a href="/hospital/"><span>Hospital</span>Management<span>System</span></a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
		  <?php
			include "login_logout.php";
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
      
        <div class="article">
          <h2>&nbsp;</h2>
        </div>
        <div class="article">
          <h2><span>Hospital Management System</span></h2>
         <!-- <img src="images/img2.jpg" width="209" height="238" alt="image" class="fl" />-->
          <p>
              This site is intended to manage the record of hospital. It manages the privilege of all users and 
              let the administrator to create some new users and manage the privilege of all users. And also this 
              site generates the report of patient and employees. 
          </p>
        </div>
      

      <div class="clr"></div>
    </div>
  </div>

  
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright <a href="#">CIB Nepal</a>. <span>Design by <a href="#" title="IOE Studnts">IOE Studnts</a></span></p>
      <div class="clr"></div>
    </div>
  </div>
</div>
</body>
</html>
