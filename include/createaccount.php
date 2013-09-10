<div class="header_black">Add User</div>
<div id="errorDisplay" class="errorMessage" style="display: none"></div>
<div align="center" class="detailDispaly">
    <form id="userDetailForm" method="POST" onsubmit="return valid.validateForm(this)?RegisterUser():false;">
        <div class="displaySection">
            <div id="inputForAll" >
                <table style="width: 50%">
                    <tr>
                        <td width="20%" valign="top" >
                            <label for="name">Name:</label>
                            <label class="star"><strong>*</strong></label></td>
                        <td width="30%" valign="top">
                            <div align="left">
                                <input type="text" class="required" name="name" id="name" maxlength="50" size="30" value="" tabindex="11"/>
                                <div class="validationError" id="nameError" style="display: none" />
                            </div></td>
                    </tr>
                    <tr>

                        <td width="20%"><label>Account Type</label></td>
                        <td width="30%">
                            <div>
                                <select id="roleList" style="width: 65%" name="roleList" class="" onchange="loadPermissionList()" >
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
                            <div id="roleListError" class="validationError" ></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                            <div class="permissionList" style="display: none">
                                <input type="checkbox" id="retrieveData" name="retrieveData" style="width: 15%;"/>
                                <label>Retrieve Data</label>
                            </div>
                        </td>
                        <td width="30%">
                            <div class="permissionList"  style="display: none">
                                <input type="checkbox" name="reportData" id="reportData" style="width: 15%;"/>
                                <label>Report Data</label>
                            </div>
                            <div id="permissionDetailError" class="validationError" ></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%"><label>Account Group: </label></td>
                        <td width="30%">
                            <div align="left">
                                    <!-- <input name="training" type="text" size="60"/>-->
                                <select id="accountList" name="accountList" class="listmenu" tabindex="13" style="width: 65%">
                                    <option value="0" selected="selected">Select Account</option>
                                </select>
                            </div>       
                            <div id="accountListError" class="validationError" ></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%"><label>Account Creation Date: </label></td>
                        <td width="30%">
                            <div>
                                <input type="date" class="date" value="<?php echo date('Y-m-d'); ?>"  name="creationDate" id="creationDate" style="width:65%" tabindex="14"/>
                                (E.g. 2013-11-29)
                                <div id="creationDateError" class="validationError" ></div>
                            </div>
                        </td> 
                    </tr>
                    <tr>
                        <td width="20%" valign="top">
                            <label for="street">Street Address:</label>        </td>
                        <td width="30%" valign="top">
                            <div align="left">
                                <input  type="text" id="street" name="street" maxlength="50" size="30" tabindex="15">
                                <div id="streetError" class="validationError" style="display: none" ></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="20%">
                            <label for="last_name">City:</label>        </td>
                        <td valign="top" width="30%">
                            <div align="left">
                                <input  type="text" name="city" id="city" maxlength="50" size="30" tabindex="16">
                            </div>
                            <div id="cityError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="20%">
                            <label for="last_name">State: </label>        </td>
                        <td valign="top" width="30%">
                            <div align="left">
                                <input  type="text" id="state" name="state" maxlength="50" size="30" tabindex="17">
                            </div>
                            <div id="stateError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="20%">
                            <label for="telephone">Phone Number: </label>        </td>
                        <td valign="top" width="30%">
                            <div align="left">
                                <input  type="text" class="phone" id="phoneNumber" name="phoneNumber" maxlength="30" size="30" tabindex="18">
                                <div id="phoneNumberError" class="validationError" style="display: none"></div>
                            </div></td>
                    </tr>
                    <tr>

                        <td width="20%"><label>Birth Date: </label></td>
                        <td width="30%">
                            <div>
                                <input class="date" type="date" name="birthDate" id="birthDate" style="width: 65%" tabindex="19"/>(E.g. 2013-11-29)
                                <div class="validationError" id="birthDateError" style="display: none" ></div>
                            </div>
                        </td> 
                    </tr>
                </table>
            </div>
            <div id="inputForPatient" style="display: none">
                <table width="50%">
                    <tr>
                        <td width="20%" valign="top"><label>Doctor</label></td>
                        <td width="30%" valign="top" >
                            <select id="doctorList" name="doctorList" class="listmenu" tabindex="20" style="width:  65%">
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
                            <div id="doctorListError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nurse</label>
                        </td>
                        <td>
                            <select id="nurseList" name="nurseList" class="listmenu" tabindex="21" style="width:  65%">
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
                            <div id="nurseListError" class="validationError" style="display: none" ></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Last Visit: </label></td>
                        <td colspan="2">
                            <?php echo "<input class='date' name='lastVisit' id='lastVisit' type='date' value='" . date("Y-m-d") . "' tabindex='22'/>"; ?>
                            (E.g. 2013-11-29)
                            <div id="lastVisitError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td ><label>Purpose of Visit: </label></td>
                        <td colspan="2" >
                            <input name="purposeOfVisit" id="purposeOfVisit" type="text" size="30" tabindex="23"/>
                            <div id="purposeOfVisitError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td ><label>Diagnosis given: </label></td>
                        <td colspan="2" >
                            <input name="diagnosis" id="diagnosis" type="text" size="30" tabindex="24"/>
                            <div id="diagnosisError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                    <tr>
                        <td ><label>Prescribed Medication: </label></td>
                        <td colspan="2" >
                            <input name="prescribedMedication" id="prscribedMedication" type="text" size="30" tabindex="25"/>
                            <div id="prscribedMedicationError" class="validationError" style="display: none"></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="buttons" class="displaySection">
            <table width="336">
                <tr>
                    <td width="90" align="center">
                        <div style="width:100%">
                            <div align="right">
                                <button class="blue-button" name="reset" type="reset" >Reset</button>
                            </div>
                        </div>
                    </td>
                    <td width="128" colspan="2" align="center" style="text-align:center">
                        <div align="right">
                            <button class="blue-button" type="submit" >Submit</button>
                        </div></td>
                </tr>
            </table>
        </div>
    </form>

</div>