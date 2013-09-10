<div id="errorDisplay" class="errorMessage" style="display: none"></div>
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
                <td width="30%">
                    <input type="text" class="required" id="name_E" name="name_E" />
                    <div id="name_EError" class="validationError" style="display: none"></div>
                </td>
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
                    <div id="roleListError" class="validationError" style="display: none"></div>
                </td>
            </tr>   
            <tr>
                <td><strong>Account Group:</strong></td>
                <td>
                    <select id="accountList" name="accountList" class="listmenu" tabindex="13">
                        <option value="0" selected="selected">Select Account</option>
                    </select>
                    <div id="accountListError" class="validationError" style="display: none"></div>
                </td>
                <td><strong>Street Address:</strong></td>
                <td>
                    <input type="text" id="streetAddress_E" name="streetAddress_E" />
                    <div id="streetAddress_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>
            <tr>
                <td><strong>State:</strong></td>
                <td valign="top">
                    <input type="text" name="state_E" id="state_E" />
                    <div id="state_EError" class="validationError" style="display: none"></div>
                </td>
                <td><strong>City:</strong></td>
                <td>
                    <input type="text" name="city_E" id="city_E" />
                    <div id="city_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>
            <tr>
                <td><strong>Birth Date:</strong></td>
                <td>
                    <input type="date" class="date" id="birthDate_E" name="birthDate_E" />
                    <div id="birthDate_EError" class="validationError" style="display: none"></div>
                </td>
                <td><strong>Phone Number:</strong></td>
                <td>
                    <input type="text" class="phone" id="phoneNumber_E" name="phoneNumber_E" />
                    <div id="phoneNumber_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>
            <tr>
                <td><strong>Creation Date:</strong></td>
                <td>
                    <input type="date" class="date" id="creationDate_E" name="creationDate_E" />
                    <div id="creationDate_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="permissionDetail_E" style="display: none" class="permissionList">
        <table width="100%" >
            <tr>
                <td><label>Report Data</label><input type="checkbox" name="reportData_E" id="reportData_E" /></td>
                <td>
                    <label>Retrieve Data</label> <input type="checkbox" name="retrieveData_E" id="retrieveData_E" />
                    <div id="permissionDetail_EError" class="validationError" style="display: none"></div>
                </td>
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
                    <div id="patientDetail_EError" class="validationError" style="display: none"></div>
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
                    <div id="nurseName_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>    
            <tr>
                <td><strong>Purpose Of Visit:</strong></td>
                <td>
                    <input type="text" id="purposeOfVisit_E" name="purposeOfVisit_E" />
                    <div id="purposeOfVisit_EError" class="validationError" style="display: none"></div>
                </td>
                <td><strong>Diagnosis Given:</strong></td>
                <td>
                    <input type="text" id="diagnosisGiven_E" name="diagnosisGiven_E" />
                    <div id="diagnosisGiven_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>   
            <tr>
                <td><strong>Medication Prescribed:</strong></td>
                <td>
                    <input type="text" id="medicationPrescribed_E" name="medicationPrescribed_E" />
                    <div id="medicationPrescribed_EError" class="validationError" style="display: none"></div>
                </td>
                <td><strong>Last Office Visit:</strong></td>
                <td valign="top">
                    <input type="date" id="lastOfficeVisit_E" name="lastOfficeVisit_E"/>
                    <div id="lastOfficeVisit_EError" class="validationError" style="display: none"></div>
                </td>
            </tr>

        </table>
    </div>               
</div>