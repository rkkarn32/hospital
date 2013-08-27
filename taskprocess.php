<?php
if(!isset($_SESSION))
    session_start();
include_once 'sql_connection.php';
include_once 'globalvariable.php';
$task = null;
if(isset($_POST['task']))
    $task = $_POST['task'];
if ($task == 'login') {
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    $returValue = $sql->LoginVerification($username, $password);
    echo json_encode($returValue);
} elseif ($task == 'loadalluser') {
    $allUser = $sql->LoadAllUser();
    echo json_encode($allUser);
} elseif ($task == 'registeruser') {
    Logger::LogInformation("Registration process Starts");
    $returnValue = array();
    $returnValue[0] = false;
    $roleid = $_POST['roleList'];
    $permission = array();
    if ($roleid == Roles::$ALA) {
        $permission = PermissionByID::$ALA;
    } else if ($roleid == Roles::$LLA) {
        $permission = PermissionByID::$LLA;
        if ($_POST['reportData'])
            array_push($permission, PermissionByID::$reportData);
        if ($_POST['retrieveData'])
            array_push($permission, PermissionByID::$retrieveData);
    }
    //echo json_encode($permission);

    $accountgroupid = $_POST['accountList'];
    $name = mysql_escape_string($_POST[name]);
    $street = mysql_escape_string($_POST[street]);
    $city = mysql_escape_string($_POST[City]);
    $state = mysql_escape_string($_POST[State]);
    $phoneno = mysql_escape_string($_POST[telephone]);
    $birthdate = mysql_escape_string($_POST[birthDate]);
    $creationdate = mysql_escape_string($_POST[creationDate]);
    $username = $sql->CreateUser($name);
    $password = md5($username);

    $doctorID = mysql_escape_string($_POST['doctorList']);
    $nurseID = mysql_escape_string($_POST['nurseList']);
    $lastVisit = $_POST['lastVisit'];
    $purposeOfVisit = $_POST['purposeOfVisit'];
    $diagnosis = $_POST['diagnosis'];
    $medication = $_POST['prescribedMedication'];
    $returnValue = $sql->RegisterUser($username, $password, $name, $street, $city, $state, $phoneno, $birthdate, $creationdate, $roleid, $accountgroupid, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication);
    if ($returnValue[0])
        $sql->AllowedPermissions($permission);
    Logger::LogInformation("Registration Done");
    echo json_encode($returnValue);
}
else if ($task == "showuserdetail") {
    $id = $_POST['id'];
    $result = $sql->GetUserDetail($id);
    echo json_encode($result);
} else if ($task == 'searchRecord') {
    $userID = mysql_escape_string($_POST['userID_Search']);
    $userName = mysql_escape_string($_POST['userName']);
    $creationDate = mysql_escape_string($_POST['accountCreationDate']);
    $roleID = mysql_escape_string($_POST['roleList']);
    $accountGroupidID = mysql_escape_string($_POST['accountGroupList']);
    $name = mysql_escape_string($_POST['txtFullName']);
    $state = mysql_escape_string($_POST['txtState']);
    $city = mysql_escape_string($_POST['txtCity']);
    $phoneno = mysql_escape_string($_POST['txPhoneNo']);
    $birthDate = mysql_escape_string($_POST['txtBirthDate']);
    $returValue = $sql->SearchRecord($userID, $userName, $creationDate, $roleID, $accountGroupidID, $name, $state, $city, $phoneno, $birthDate);
    echo json_encode($returValue);
} elseif ($task == "updateRecord") {
    $returnValue = array();
    $userID = $_POST['userId_E'];
    Logger::LogInformation("User ID: " . $userID);
    $userName = mysql_escape_string($_POST['userName_E']);
    $name = mysql_escape_string($_POST['name_E']);
    $roleID = mysql_escape_string($_POST['roleList']);
    
    $permission = array();
    if ($roleID == Roles::$ALA) {
        $permission = PermissionByID::$ALA;
    } else if ($roleID == Roles::$LLA) {
        $permission = PermissionByID::$LLA;
        if ($_POST['reportData_E'])
            array_push($permission, PermissionByID::$reportData);
        if ($_POST['retrieveData_E'])
            array_push($permission, PermissionByID::$retrieveData);
    }
    
    $groupID = mysql_escape_string($_POST['accountList']);
    $streetAddress = mysql_escape_string($_POST['streetAddress_E']);
    $state = mysql_escape_string($_POST['state_E']);
    $city = mysql_escape_string($_POST['city_E']);
    $birthDate = mysql_escape_string($_POST['birthDate_E']);
    $phoneno = mysql_escape_string($_POST['phoneNumber_E']);
    $creationDate = mysql_escape_string($_POST['creationDate_E']);

    $doctorID = mysql_escape_string($_POST['doctorName_E']);
    $nurseID = mysql_escape_string($_POST['nurseName_E']);
    $purposeOfVisit = mysql_escape_string($_POST['purposeOfVisit_E']);
    $diagnosis = mysql_escape_string($_POST['diagnosisGiven_E']);
    $medication = mysql_escape_string($_POST['medicationPrescribed_E']);
    $lastVisit = mysql_escape_string($_POST['lastOfficeVisit_E']);
    $sql = new SqlConnection();
    $returnValue[0] = $sql->UpdateUserDetail($userID, $username, $name, $streetAddress, $city, $state, $phoneno, $birthDate, $creationDate, $roleID, $groupID, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication);
    if($returnValue[0])
        $returnValue[0] = $sql->UpdatePermissionList($permission,$userID);
    else
        Logger::LogInformation ("User Update failed");
    echo json_encode($returnValue);
//    }
} elseif ($task == 'showpermissionlist') {
    $userID = $_POST['userid'];
    $permissions = $sql->PermissionList($userID);
    echo json_encode($permissions);
}
elseif($task == 'changeusername'){
    $newUsername = $_POST['newUsername'];
    $returnValue = $sql->ChangeUsername($newUsername);
    echo json_encode($returnValue);
}
elseif($task == 'changepassword'){
    $newPassword= mysql_escape_string($_POST['newPassword']);
    $returnValue = $sql->ChangePassword($newPassword);
    echo json_encode($returnValue);
}elseif($task == 'deleteuser'){
    $returnValue= $sql->DeleteUser($_POST['id']);
    echo json_encode($returnValue);
}

?>
