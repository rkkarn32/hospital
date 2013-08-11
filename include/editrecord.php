<div id="userDetail" class="displaySection">
    <div class="generalDetail_E">
        <table width="100%"> 
            <tr>
                <td width="20%" ><strong>User ID:</strong></td>
                <td width="30%"><input type="text" disabled="disabled" id="userID_E" name="userID_E"/></td>
                <td width="20%"><strong>User name:</strong></td>
                <td width="30%"><input type="text" id="userName_E" disabled="disabled" name="userName_E" /></td>
            </tr>    
            <tr>
                <td width="20%" ><strong>Name:</strong></td>
                <td width="30%"><input type="text" id="name_E" name="name_E" /></td>
                <td width="20%"><strong>Account Type:-</strong></td>
                <td width="30%">
                    <div >
                        <select id="roleList" name="roleList" class="listmenu" onchange="loadPermissionList()" >
                            <option selected="selected" value="0" tabindex="12" onchange="" >Select Role</option>
                            <?php
                            Logger::LogInformation("Loading Role List");
                            $roleList = $sql->GetRoles($_SESSION['userid']);
                            foreach ($roleList as $role) {
                                echo "<option value='" . $role[0] . "'>" . $role[1] . "</option>";
                            }
                            Logger::LogInformation("Role List Loaded");
                            ?>
                        </select>
                    </div>
                </td>
            </tr>   
            <tr>
                <td><strong>Account Group:</strong></td>
                <td>
                    <select id="accountList" name="accountList" class="listmenu" tabindex="13">
                        <option value="0" selected="selected">Select Account</option>
                    </select>
                </td>
                <td><strong>Street Address:</strong></td>
                <td><input type="text" id="streetAddress_E" name="streetAddress_E" /></td>
            </tr>
            <tr>
                <td><strong>State:</strong></td>
                <td valign="top"><input type="text" name="state_E" id="state_E" /></td>
                <td><strong>City:</strong></td>
                <td><input type="text" name="city_E" id="city_E" /></td>
            </tr>
            <tr>
                <td><strong>Birth Date:</strong></td>
                <td><input type="date" id="birthDate_E" name="birthDate_E" /></td>
                <td><strong>Phone Number:</strong></td>
                <td><input type="text" id="phoneNumber_E" name="phoneNumber_E" /></td>
            </tr>
            <tr>
                <td><strong>Creation Date:</strong></td>
                <td><input type="date" id="creationDate_E" name="creationDate_E" /></td>
            </tr>
        </table>
    </div>
    <div id="permissionDetail_E" style="display: none" class="permissionList">
        <table width="100%" >
            <tr>
                <td><label>Report Data</label><input type="checkbox" name="reportData_E" id="reportData_E" /></td>
                <td><label>Retrieve Data</label> <input type="checkbox" name="retrieveData_E" id="retrieveData_E" /></td>
            </tr>
        </table>
    </div>
    <div id="patientDetail_E">
        <table width="100%" >
            <tr>
                <td width="20%" ><strong>Doctor Name:</strong></td>
                <td width="30%">
                    <select id="doctorName_E" name="doctorName_E">
                        <?php
                        Logger::LogInformation("Loading Doctor List");
                        $doctorList = $sql->GetUserNameByAccountType("Doctor");
                        if (!$doctorList)
                            echo"<option value='0' selected='selected'>No Doctor Found</option>";
                        else {
                            echo"<option value='0' selected='selected'>Select Doctor</option>";
                            while ($row = mysql_fetch_array($doctorList))
                                echo"<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                            Logger::LogInformation("Doctor List Loaded");
                        }
                        ?>
                    </select>

                </td>
                <td width="20%"><strong>Nurse Name:</strong></td>
                <td width="30%">
<!--                    <input type="text" id="nurseName_E" name="nurseName_E" />-->
                    <select id="nurseName_E" name="nurseName_E">
                        <?php
                        Logger::LogInformation("Loading Nurse List");
                        $nurseList = $sql->GetUserNameByAccountType("Nurse");
                        if (!$nurseList)
                            echo"<option value='0' selected='selected'>No Doctor Found</option>";
                        else {
                            echo"<option value='0' selected='selected'>Select Nurse</option>";

                            while ($row = mysql_fetch_array($nurseList))
                                echo"<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                            Logger::LogInformation("Nurse List Loaded");
                        }
                        ?>
                    </select>
                </td>
            </tr>    
            <tr>
                <td><strong>Purpose Of Visit:</strong></td>
                <td><input type="text" id="purposeOfVisit_E" name="purposeOfVisit_E" /></td>
                <td><strong>Diagnosis Given:</strong></td>
                <td><input type="text" id="diagnosisGiven_E" name="diagnosisGiven_E" /></td>
            </tr>   
            <tr>
                <td><strong>Medication Prescribed:</strong></td>
                <td><input type="text" id="medicationPrescribed_E" name="medicationPrescribed_E" /></td>
                <td><strong>Last Office Visit:</strong></td>
                <td valign="top"><input type="date" id="lastOfficeVisit_E" name="lastOfficeVisit_E" /></td>
            </tr>

        </table>
    </div>               
</div>