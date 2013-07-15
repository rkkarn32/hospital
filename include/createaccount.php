<?php
session_start();
include_once 'sql_connection.php';
?>
<div align="center">
    <form id="userDetailForm" method="POST" onsubmit="return RegisterUser()?true:false">
            <div id="inputForAll">
            <table>
    	<tr>
            <td width="144" valign="top" >
          <label for="name">Name</label>            </td>
            <td width="184" valign="top">
            <div align="right">
                <input  type="text" name="name" maxlength="50" size="30" value="" />
          </div></td>
        </tr>
        <tr>
            <td>Account Type</td>
            <td>
                <div align="right">
                    <select id="roleList" name="roleList" class="listmenu" style="width: 100%"  onchange="ShowHidePatient()">
                    <option selected="selected" value="0" >Select Role</option>
                    <?php
                        Logger::LogInformation("Loading Role List");
                        $roleList = $sql->GetRoles($_SESSION['userid']);
                        foreach ($roleList as $role) {
                            echo "<option value='".$role[0]."'>".$role[1]."</option>";
                        }
                        Logger::LogInformation("Role List Loaded");
                    ?>
                    </select>
                </div>            </td>
        </tr>
        <tr>
            <td>Account Group</td>
            <td>
            <div align="right">
                    <!-- <input name="training" type="text" size="60"/>-->
                <select id="accountList" name="accountList" class="listmenu" style="width:100%">
                    <option value="0" selected="selected">Select Account</option>
                    <?php
                        Logger::LogInformation("Loading AccountType List");
                        $accountList = $sql->GetAccountList();
                        foreach ($accountList as $account) {
                            echo "<option value='".$account[0]."'>".$account[1]."</option>";
                        }
                        Logger::LogInformation("AccountType List Loaded");
                    ?>
                </select>
            </div>            </td>
        </tr>
        <tr>
            <td>Account Creation Date</td>
            <td><div align="right">
            <input type="date" value="<?php echo date('Y-m-d'); ?>"  name="creationdate" style="width:95%"/>
            </div></td> 
        </tr>   
        <tr>
        <td valign="top">
        <label for="last_name">Street Address</label>        </td>
        <td valign="top">
        <div align="right">
            <input  type="text" name="street" maxlength="50" size="30">
            </div></td>
        </tr>
        <tr>
        <td valign="top">
        <label for="last_name">City</label>        </td>
        <td valign="top">
        <div align="right">
            <input  type="text" name="City" maxlength="50" size="30">
            </div></td>
        </tr>
        <tr>
        <td valign="top">
        <label for="last_name">State</label>        </td>
        <td valign="top">
        <div align="right">
            <input  type="text" name="State" maxlength="50" size="30">
            </div></td>
        </tr>
        <tr>
        <td valign="top">
        <label for="telephone">Phone Number</label>        </td>
        <td valign="top">
        <div align="right">
            <input  type="text" name="telephone" maxlength="30" size="30">
            </div></td>
        </tr>
        <tr>
                                        <td>Birth Date</td>
                                        <td><div align="right">
                                                <input type="date" name="birthdate" style="width: 95%"/>			
                                    </div></td> 
              </tr>
    </table>
            </div>
            <div id="inputForPatient">
                <table>
                    <tr>
                        <td width="142" valign="top"><div align="left">Doctor</div></td>
                      <td width="191" valign="top" style="text-align:right">
                          <select id="doctorList" name="doctorList" class="listmenu" style="width: 100%">
                              <?php
                                Logger::LogInformation("Loading Doctor List");
                                 $doctorList = $sql->GetUserNameByAccountType("Doctor");                                
                                 if(!$doctorList)
                                     echo"<option value='0' selected='selected'>No Doctor Found</option>";
                                 else{
                                     echo"<option value='0' selected='selected'>Select Doctor</option>";
                                     while($row = mysql_fetch_array($doctorList))
                                         echo"<option value='".$row[0]."'>".$row[1]."</option>";
                                     Logger::LogInformation("Doctor List Loaded");
                                 }
                              ?>
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div align="left">Nurse</div></td>
                      <td colspan="2" style="text-align:center" align="center">
                          <select id="nurseList" name="nurseList" class="listmenu" style="width: 100%">
                              <?php
                                Logger::LogInformation("Loading Nurse List");
                                 $nurseList = $sql->GetUserNameByAccountType("Nurse");                                
                                 if(!$nurseList)
                                     echo"<option value='0' selected='selected'>No Doctor Found</option>";
                                 else{
                                     echo"<option value='0' selected='selected'>Select Nurse</option>";
                                     
                                     while($row = mysql_fetch_array($nurseList))
                                         echo"<option value='".$row[0]."'>".$row[1]."</option>";
                                     Logger::LogInformation("Nurse List Loaded");
                                 }
                              ?>
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div align="left">Last Visit </div></td>
                      <td colspan="2" style="text-align:center" align="center">
                          <?php echo "<input name='lastVisit' type='date' style='width: 100%' value='".date("Y-m-d")."' />"; ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div align="left">Purpose of Visit </div></td>
                      <td colspan="2" style="text-align:center" align="center">
                          <input name="purposeOfVisit" type="text" style="width: 100%" size="30"/>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div align="left">Diagnosis given </div></td>
                      <td colspan="2" style="text-align:center" align="center">
                          <input name="diagnosis" type="text" style="width: 100%" size="30" />
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div align="left">Prescribed Medication </div></td>
                      <td colspan="2" style="text-align:center" align="center">
                          <input name="prescribedMedication" type="text" style="width: 100%" size="30"/>
                      </td>
                    </tr>
              </table>
            </div>


      <div id="buttons">
        <table width="336">
          <tr>
            <td width="90" align="center"><div style="width:100%">
              
              <div align="right">
                <input name="reset" type="reset" />
                </div>
            </div></td>
            <td width="128" colspan="2" align="center" style="text-align:center">
              <div align="right">
                <input type="submit" />
              </div></td>
          </tr>
        </table>
      </div>
    </form>
 
</div>