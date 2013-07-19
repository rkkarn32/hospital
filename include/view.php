<script type="text/javascript">
//    ShowUserDetails($('#userID').html());
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
<div id="viewDetail" style="display: ">
    <div class="generalDetail">
        <table width="100%" border="1px"> 
            <tr>
                <td width="27%" ><strong>Name:-</strong></td>
                <td width="32%"><div id="name" align="left"></div></td>
                <td width="20%"><strong>Account Type:-</strong></td>
                <td width="21%"><div id="accountType" align="left"></div></td>
            </tr>    
            <tr>
                <td><strong>Account Group:-</strong></td>
                <td><div align="left" id="accountGroup"></div></td>
                <td><strong>Creation Date:-</strong></td>
                <td><div align="left" id="creationDate"></div></td>
            </tr>   
            <tr>
                <td><strong>Street Address:-</strong></td>
                <td><div align="left" id="streetAddress"></div></td>
                <td><strong>State:-</strong></td>
                <td valign="top"><div align="left" id="state"></div></td>
            </tr>
            <tr>
                <td><strong>City:-</strong></td>
                <td><div align="left" id="city"></div></td>
                <td><strong>Birth Date:-</strong></td>
                <td><div align="left" id="birthDate"></div></td>
            </tr>
            <tr>
                <td><strong>Phone Number:-</strong></td>
                <td><div align="left" id="phoneNumber"></div></td>
            </tr>
        </table>
    </div>
    <div id="patientDetail">
        <table width="100%" border="1px">
            <tr>
                <td width="27%" ><strong>Doctor Name:-</strong></td>
                <td width="32%"><div align="left" id="doctorName"></div></td>
                <td width="20%"><strong>Nurse Name:-</strong></td>
                <td width="21%"><div align="left" id="nurseName"></div></td>
            </tr>    
            <tr>
                <td><strong>Purpose Of Visit:-</strong></td>
                <td><div align="left" id="purposeOfVisit"></div></td>
                <td><strong>Diagnosis Given:-</strong></td>
                <td><div align="left" id="diagnosisGiven"></div></td>
            </tr>   
            <tr>
                <td><strong>Medication Prescribed:-</strong></td>
                <td><div align="left" id="medicationPrescribed"></div></td>
                <td><strong>Last Office Visit:-</strong></td>
                <td valign="top"><div align="left" id="lastOfficeVisit"></div></td>
            </tr>

        </table>
    </div>               
    <div align="center" class="print">
        <input type="button" value="Print" onClick="PrintElem('#viewDetail')" />
    </div>
</div>