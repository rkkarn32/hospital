<?php 
include_once 'sql_connection.php';
				      
   $sql = new SqlConnection();
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
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }

</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="mydiv">
		<div class="member">
            	<table width="100%" border="1px"> 
   			  <tr>
               	<td width="27%" ><strong>Name:-</strong></td>
           	    <td width="32%"><div align="left"><?php echo $user['name']; ?></div></td>
                <td width="20%"><strong>Account Type:-</strong></td>
    			<td width="21%"><div align="left"><?php echo $type['role']; ?></div></td>
  			  </tr>    
			  <tr>
   			 	<td><strong>Account Group:-</strong></td>
			    <td><div align="left"><?php echo $group['groupname'];?></div></td>
                <td><strong>Creation Date:-</strong></td>
				<td><div align="left"><?php echo $user['creationdate']; ?></div></td>
			  </tr>   
			  <tr>
				<td><strong>Street Address:-</strong></td>
			    <td><div align="left"><?php echo $user['street']; ?></div></td>
                <td><strong>State:-</strong></td>
				<td valign="top"><div align="left"><?php echo $user['state']; ?></div></td>
			  </tr>
			  <tr>
				<td><strong>City:-</strong></td>
			    <td><div align="left"><?php echo $user['city']; ?></div></label></td>
                <td><strong>Birth Date:-</strong></td>
				<td><div align="left"><?php echo $user['birthdate']; ?></div></td>
			  </tr>
			  <tr>
				<td><strong>Phone Number:-</strong></td>
			    <td><div align="left"><?php echo $user['phoneno']; ?></div></td>
			  </tr>
              </table>
              <div>
            	<table width="100%" border="1px">
   			  <tr>
               	<td width="27%" ><strong>Doctor Name:-</strong></td>
           	    <td width="32%"><div align="left"><?php echo $user['doctorname']; ?></div></td>
                <td width="20%"><strong>Nurse Name:-</strong></td>
    			<td width="21%"><div align="left"><?php echo $type['nursename']; ?></div></td>
  			  </tr>    
			  <tr>
   			 	<td><strong>Purpose Of Visit:-</strong></td>
			    <td><div align="left"><?php echo $group['purposeofvisit'];?></div></td>
                <td><strong>Dagnosis Given:-</strong></td>
				<td><div align="left"><?php echo $user['diagnosis']; ?></div></td>
			  </tr>   
			  <tr>
				<td><strong>Medication Prescribed:-</strong></td>
			    <td><div align="left"><?php echo $user['medication']; ?></div></td>
                <td><strong>Last Office Visit:-</strong></td>
				<td valign="top"><div align="left"><?php echo $user['lastvisit']; ?></div></td>
			  </tr>
		
                </table>
          </div>               
        </div>
	</div>
	<div align="center" class="print">
		<input type="button" value="Print" onClick="PrintElem('#mydiv')" />
	</div>
</body>
</html>
