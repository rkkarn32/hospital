<?php session_start();
include_once 'sql_connection.php';
    $task = $_POST['task'];
    if($task == 'login'){
        Logger::LogInformation("Login Done");
        $username = mysql_escape_string($_POST['username']);
        $password = md5(mysql_escape_string($_POST['password']));
        $returValue = $sql->LoginVerification($username,$password);
        echo json_encode($returValue);
    }
    elseif($task == 'loadalluser'){
        $allUser = $sql->LoadAllUser();
        echo json_encode($allUser);
    }
    elseif($task == 'registeruser'){
        Logger::LogInformation("Registration process Starts");
        $returnValue = array();
        $returnValue[0]= false;
        
        $roleid = $_POST['roleList'];
        $accountgroupid=$_POST['accountList'];
        $name = mysql_escape_string($_POST[name]);
        $street = mysql_escape_string($_POST[street]);
        $city = mysql_escape_string($_POST[City]);
        $state = mysql_escape_string($_POST[State]);
        $phoneno = mysql_escape_string($_POST[telephone]);
        $birthdate = mysql_escape_string($_POST[birthdate]);
        $creationdate = mysql_escape_string($_POST[creationdate]);
        $username = $sql->CreateUser($name);
        $password = md5($username);

        $doctorID= mysql_escape_string($_POST['doctorList']);
        $nurseID= mysql_escape_string($_POST['nurseList']);
        $lastVisit = $_POST['lastVisit'];
        $purposeOfVisit = $_POST['purposeOfVisit'];
        $diagnosis = $_POST['diagnosis'];
        $medication = $_POST['prescribedMedication'];

        $returnValue = $sql->RegisterUser($username,$password,$name,$street,$city,$state,$phoneno,$birthdate,$creationdate,$roleid,$accountgroupid,$doctorID,$nurseID,$lastVisit,$purposeOfVisit,$diagnosis,$medication);
        Logger::LogInformation("Registration Done");
    echo json_encode($returnValue);
    }
    else if($task == "showuserdetail"){
        $id= $_POST['id'];
        $result = $sql->GetUserDetail($id);
        echo json_encode($result);
    }
    else if($task =='searchRecord'){
        $userName = mysql_escape_string($_POST['userName']);
        $creationDate = mysql_escape_string($_POST['accountCreationDate']);
        $roleID = mysql_escape_string($_POST['roleList']);
        $accountGroupidID = mysql_escape_string($_POST['accountGroupList']);
        $name = mysql_escape_string($_POST['txtFullName']);
        $state = mysql_escape_string($_POST['txtState']);
        $city = mysql_escape_string($_POST['txtCity']);
        $phoneno =  mysql_escape_string($_POST['txPhoneNo']);
        $birthDate = mysql_escape_string($_POST['txtBirthDate']);
        $returValue = $sql->SearchRecord($userName,$creationDate,$roleID,$accountGroupidID,$name, $state,$city,$phoneno,$birthDate);
        echo json_encode($returValue);
    }
?>
