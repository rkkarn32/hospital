<?php
session_start();
include_once 'sql_connection.php';
?>



<table  width="100%" class="displaySection">
    <tr>
        <td width="20%" ><strong>User ID:-</strong></td>
        <td width="30%"><input class="inp-form" id="userID_Search" name="userID_Search" type="text" style="width: 80%" maxlength="50" tabindex="11"/></td>
        <td width="20%" ><strong>User name:-</strong></td>
        <td width="30%"><input class="inp-form" id="userName" name="userName" type="text" style="width: 80%" maxlength="50" tabindex="11"/></td>
    </tr>    
    <tr>
        <td width="20%" ><strong>Creation Date:-</strong></td>
        <td width="30%" valign="top"><input class="inp-form" id="accountCreationDate" name="accountCreationDate" type="date" tabindex="13" style="width: 80%"/></td>
        <td width="20%">Role </td>
        <td width="20%">
            <div>
                <select id="roleList" name="roleList" class="listmenu" onchange="ShowHidePatient()" tabindex="14">
                    <option selected="selected" value="" tabindex="12" >Select Role</option>
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
        <td width="20%"><strong>Account Group:-</strong></td>
        <td width="30%">
            <select id="accountGroupList" name="accountGroupList" class="listmenu" tabindex="15">
                <option value="" selected="selected">Select Account</option>
                <?php
                Logger::LogInformation("Loading AccountType List");
                $accountList = $sql->GetAccountList();
                foreach ($accountList as $account) {
                    echo "<option value='" . $account[0] . "'>" . $account[1] . "</option>";
                }
                Logger::LogInformation("AccountType List Loaded");
                ?>
            </select>
        </td>
        <td width="20%"><strong>Full name:-</strong></td>
        <td width="30%"><input class="inp-form" type="text" name="txtFullName" tabindex="16" maxlength="50" style="width: 80%"/></td>
    </tr>
    <tr>
        <td width="20%"><strong>State:-</strong></td>
        <td width="30%" ><input type="text" class="inp-form" name="txtState" tabindex="17" maxlength="50" style="width: 80%" /></td>
        <td width="20%"><strong>City:-</strong></td>
        <td width="30%"><input type="text" name="txtCity" class="inp-form" tabindex="18" maxlength="50" style="width: 80%" /></td>
    </tr>
    <tr>
        <td width="20%"><strong>Phone Number:-</strong></td>
        <td width="30%"><input class="inp-form" type="text" name="txtPhoneNo" tabindex="19" maxlength="50" style="width: 80%" /></td>
        <td><strong>Birth Date:-</strong></td>
        <td><input class="inp-form" type="date" name="txtBirthDate" tabindex="20"  style="width: 80%" /></td>
    </tr>
</table>