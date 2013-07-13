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
        $sqlConnection = new SqlConnection();
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
        
        $returnValue = $sql->RegisterUser($username,$password,$name,$street,$city,$state,$phoneno,$birthdate,$creationdate,$roleid,$accountgroupid);
    echo json_encode($returnValue);
    }
?>
