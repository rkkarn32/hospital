<?php
  $db_link = mysql_connect("localhost","root");
  if(!$db_link)
    die("There is some error" .mysql_errno());
    
  $db_select=mysql_selectdb("cib_system",$db_link);
  if(!$db_select)
  die("Data base not found ".mysql_errno());
  
  for($i =1 ;$i<32;$i++)
  {
      $data="insert into day values ('".$i."')";
      $result = mysql_query($data,$db_link);
      
  }
  echo "work finished == database updated";
  
?>
