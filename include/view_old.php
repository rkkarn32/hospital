<?php 
include_once 'sql_connection.php';
				      
        $sql = new SqlConnection();
		//$sql->CreateUser($name,$street,$city,$state,$phoneno,$birthdate,$creationdate,$roleid,$accountgroupid); 
        

   $user = $sql->User(1);
   $type = $sql->type($user['roleid']);
   $group = $sql->group($user['accountgroupid']);
   
?>

<html>
<head>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Your details</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
</head>
<body>

<div id="mydiv">
  <div>
<div style="float:left; width:50%">
	<table align="left">
    	<tr>
 			<td >
			  <label for="first_name">Name</label>
			  :-
 			</td>
	  <td width="188" valign="top">
<div align="right">
  				  <label for="first_name"><?php echo $user['name']; ?></label>
		        </div></td>
	  </tr>
    
  <tr>
    <td>Account Group:-</td>
    <td>
    <div align="right">
            <?php echo $group['groupname']; ?>
     </div>
    </td>
  </tr>
   
<tr>
 <td valign="top"">
  <label for="last_name">Street Address</label>
 </td>
 <td valign="top">
   <div align="right">
     <label for="last_name"><?php echo $user['street']; ?></label>
     </div></td>
</tr>
<tr>
 <td valign="top"">
  <label for="last_name">City</label>
 </td>
 <td valign="top">
   <div align="right">
     <label for="last_name"><?php echo $user['city']; ?></label>
     </div></td>
</tr>

<tr>
 <td valign="top">
  <label for="telephone">Phone Number</label>
 </td>
 <td valign="top">
   <div align="right">
     <label for="last_name"><?php echo $user['phoneno']; ?></label>
     </div></td>
</tr>



<tr>


 
</tr>
    </table>
 </div>
 <div>
	<table style="float:right; width:50%">

    <?php
   
	$A_type_array = "ALA,LLA,Patient";
	$A_group_array = "Doctor,Nurse,Patient";
	
	$explod_type = explode(",",$A_type_array);
	$explod_group = explode(",",$A_group_array);

	?>
  <tr>
    <td>Account Type:-</td>
    <td>
      <div align="right">
        <?php echo $type['role']; ?>
      </div>
    </td>
  </tr>

  <tr>
		  		<td>Account Creation Date</td>
				 <td><div align="right">
				   <label for="last_name"><?php echo $user['creationdate']; ?></label>
                   			
			     </div></td> 
                 
              </tr>   


<tr>
 <td valign="top"">
  <label for="last_name">State</label>
 </td>
 <td valign="top">
   <div align="right">
     <label for="last_name"><?php echo $user['state']; ?></label>
     </div></td>
</tr>

<tr>
		  		<td>Birth Date</td>
				 <td><div align="right">
				   <label for="last_name"><?php echo $user['birthdate']; ?></label>			
			     </div></td> 
                 
              </tr>


<tr>


 
</tr>
    </table>
</div>
</div>
</div>



<input type="button" value="Print Detail" onclick="PrintElem('#mydiv')" />

</body>
</html>
