<?php

include_once 'logger.php';
include_once 'globalvariable.php';

class SqlConnection {

    private $startLocalIP = "126.168.1.2";          //Local IP Range
    private $endLocalIP = "200.0.1.150";
    private $db_name = "hospital";                  //Database Information
    private $db_link;
    private $sql_username = "root";                 //SQL setting
    private $sql_password = "";
    private $userid;                                //User settings
    private $username;
    private $roleid;

    public function __construct() {
        $this->db_link = mysql_connect("localhost", $this->sql_username, $this->sql_password);   // Database connection
        if (!$this->db_link) {
            Logger::LogInformation("MySQL connection problem, Error: " . mysql_error());
            die('MySQL not connected, Error:' . mysql_error());
        }
        $db_selected = mysql_select_db($this->db_name, $this->db_link);
        if (!$db_selected) {
            Logger::LogInformation("Database not connected, Error: " . mysql_error());
            die('Database not selected, Error: ' . myslq_error());
        }
    }

    public function LoginVerification($uname, $pword) {
        Logger::LogInformation("LoginVerification()## Login process started");
        $returnValue = array();
        $returnValue[0]=0;
        $sql = "SELECT * FROM userdetail WHERE username = '" . $uname . "' AND password ='" . $pword . "'";
        $result = mysql_query($sql, $this->db_link);
        if (!$result)
        {
            Logger::LogInformation("LoginVerification()## Login failed, Error: " . mysql_error());
            $returnValue[1] = mysql_error();
            return $returnValue;
        }
        while ($row = mysql_fetch_array($result)) {

            if (!$this->IsVisitorLocal($this->GetVisitorIP()) AND $row['roleid'] != 4) {
                Logger::LogInformation("LoginVerification()## Login from unauthorized location");
                $returnValue[0] = 0;
                $returnValue[1]="Remot login is not authenticated for Staff account";
                Logger::LogInformation("LoginVerification()## Login failed, Error: Staff cannot login from remote");
                return $returnValue;
            }
            $returnValue[0] = 1;
            $returnValue[1] = $row['verified'];
            $returnValue[2] = $row['name'];
            $this->userid = $row['userid'];
            $_SESSION['loggedin'] = 1;
            $_SESSION['userid'] = $this->userid;
            $_SESSION['roleid'] = $row['roleid'];
            $_SESSION['username'] = $row['username'];
            if (!$row['verified'])
                $this->UpdateLoginVerified($this->userid);
            Logger::LogInformation("LoginVerification()## Successfully Logged In by User:" . $row['name']);
            return $returnValue;
        }
        $returnValue[0] = 0;
        $returnValue[1]= "Username and password didn't matched";
        Logger::LogInformation("LoginVerification()## Login Failed, Error: Username and password didn't matched");
        return $returnValue;
    }

    /**
     * Check this visitor is authorised to access this page or not.
     * @param type $IP IP of visitor
     * @return Number The access privilege
     */
    private function IsVisitorLocal($IP) {
//        $startValue = sprintf('%u',ip2long($this->startLocalIP));
//        $endValue = sprintf('%u',ip2long($this->endLocalIP));
//        $currentIP = sprintf('%u',ip2long($IP));
        $startValue = sprintf('%u', ip2long($this->startLocalIP));
        $endValue = sprintf('%u', ip2long($this->endLocalIP));
        $currentIP = sprintf('%u', ip2long($IP));
//        Logger::LogInformation("Start IP" . $startValue . " , End IP" . $endValue . "=$this->endLocalIP , current IP" . $currentIP);

        if ($startValue <= $currentIP AND $currentIP <= $endValue) {
            Logger::LogInformation("IsVistorLocal()## Visitor is local, IP=" . $IP);
            return true;
        } else {
            Logger::LogInformation("IsVistorLocal()## Visitor isn't local, IP=" . $IP);
            return false;
        }
    }

    /**
     * This method returns the public IP of visitor.
     * @return ip Visitor's public IP 
     */
    private function GetVisitorIP() {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
            $ipaddress = getenv('REMOTE_ADDR');
            Logger::LogInformation("GetVisistorIP()## IP address is : " . $pipaddress . "(via $ipaddress)");
        } else {
            $ipaddress = getenv('REMOTE_ADDR');
            Logger::LogInformation("GetVisistorIP()## Your IP address is : $ipaddress");
        }
        return $ipaddress;
    }

    private function UpdateLoginVerified($id) {
        $query = "UPDATE userdetail SET verified =1 WHERE userid='$id'";
        $result = mysql_query($query);
        if (!$result)
            Logger::LogInformation("UpdateLoginVerified() ## Query isn't executed, Error: " . mysql_error());
        else
            Logger::LogInformation("UpdateLoginVerified() ## Verified status updated for id='$id'");
    }

    function LoadAllUser() {
        $allUser = array();
        $allUser[0][0] = 0;

        $sql = "SELECT userid,name,role,groupname FROM userdetail UD,roles R,accountgroup AG WHERE UD.roleid > "
                . $_SESSION['roleid'] . " AND UD.roleid=R.roleid AND UD.groupid=AG.groupid";
//        $sql = "SELECT userid,name FROM userdetail";
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            Logger::LogInformation("LoadAllUser()## Query isn't executed, Error: " . mysql_error());
            return $allUser;
        }
        Logger::LogInformation("LoadAllUser(), User List loaded Successfully");
        $i = 0;
        $allUser[0][0] = 0;
        while ($row = mysql_fetch_array($result)) {
            $allUser[$i] = array();
            array_push($allUser[$i], $row[0]);
            array_push($allUser[$i], $row[1]);
            array_push($allUser[$i], $row[2]);
            array_push($allUser[$i], $row[3]);

            $i++;
        }
        return $allUser;
    }

    public function RegisterUser($username, $password, $name, $street, $city, $state, $phoneno, $birthdate, $creationdate, $roleid, $groupid, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication) {
        $query = "insert into userdetail set username='$username', password='$password', name='$name', street='$street', city='$city', phoneno='$phoneno', creationdate='$creationdate', roleid='$roleid', groupid='$groupid',birthdate='$birthdate',state='$state' ";
        Logger::LogInformation("RegisterUser()## your Query is : " . $query);
        $result = array();
        $result[0] = mysql_query($query, $this->db_link);
        if (!$result[0]) {
            Logger::LogInformation("RegisterUser()## Query isn't executed, Error: " . mysql_error());
            $result[0] = false;
        } else if ($roleid == 4)
            $result[0] = $this->RegisterPatient($doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication);
        else
            Logger::LogInformation("RegisterUser(), Registration for $name is Successfull");
        return $result;
    }

    public function AllowedPermissions($permission) {
        $userID = $this->GetRecentUserID();
        foreach ($permission as $perm) {
            $query = "INSERT INTO userpermission VALUES('$userID','$perm')";
            $result = mysql_query($query);
            if (!$result) {
                Logger::LogInformation("AllowedPermissions()## Query isn't executed, Error: " . mysql_error());
                return false;
            }
        }
        Logger::LogInformation("AllowedPermission()##, Permissions Set for id=$userID");
        return true;
    }
    public function UpdatePermissionList($permissionList, $userID){
        $query = "DELETE FROM userpermission WHERE userid = ".$userID;
        $result = mysql_query($query);
        Logger::LogInformation("UpdatePermissionList()## Query is :".$query);
        if(!$result)
        {
            Logger::LogInformation("UpdatePermissionList()## Error in deleting the pre-existing permissions, Error : ".mysql_error());
            return false;
        }
        foreach ($permissionList as $perm) {
            $query = "INSERT INTO userpermission VALUES('$userID','$perm')";
            $result = mysql_query($query);
            Logger::LogInformation("UpdatePermissionList()## Query is : ".$query);
            if (!$result) {
                Logger::LogInformation("UpdatePermissionList()## Error Occured during updating the permissions: " . mysql_error());
                return false;
            }
        }
        Logger::LogInformation("UpdatePermissionList()##, Permissions updated for userID=$userID");
        return true;
    }

    private function GetRecentUserID() {
        $queryUserID = "SELECT max(userid) FROM userdetail";
        $resultUserID = mysql_query($queryUserID);
        $row = mysql_fetch_array($resultUserID);
        return $row[0];
    }

    private function RegisterPatient($doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication) {
//        $queryUserID = "SELECT max(userid) FROM userdetail";
//        $resultUserID = mysql_query($queryUserID);
//        $row = mysql_fetch_array($resultUserID);
//        $userid = $row[0];
        $userid = $this->GetRecentUserID();
        $query = "INSERT INTO patient VALUES ('','$userid','$doctorID','$nurseID','$lastVisit','$purposeOfVisit','$diagnosis','$medication')";
        $result = mysql_query($query);
        if (!$result) {
//            Logger::LogInformation("RegisterPatient()## Query is " . $query);
            Logger::LogInformation("RegisterPatient()## Data isn't inserted, Error: " . mysql_error());
        }
        else
            Logger::LogInformation("RegisterPatient()## Patient data inserted");
        return $result;
    }

    /**
     * Returns the all Roles who is lower privilege than current user.
     * @param $uID is ID of current user
     * @return Array It returns the array of roles.
     */
    public function GetRoles($uID) {
        //$sql = "SELECT * FROM roles WHERE roleid>".$uID;
        $sql = "SELECT * FROM roles WHERE roleid>" . $_SESSION['roleid'];
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            Logger::LogInformation("GetRoles## Query isn't executed, Error:" . mysql_error());
        }
        $roleList = array();
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $roleList[$i] = array();
            array_push($roleList[$i], $row[0]);
            array_push($roleList[$i], $row[1]);
            $i++;
        }
        return $roleList;
    }

    public function GetAccountList() {
        $sql = "SELECT * FROM accountgroup";
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            Logger::LogInformation("GetAccountList()## Query isn't executed, Error: " . mysql_error());
        }
        $accountList = array();
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $accountList[$i] = array();
            array_push($accountList[$i], $row[0]);
            array_push($accountList[$i], $row[1]);
            $i++;
        }
        return $accountList;
    }

    public function ExecuteQuery($query) {
        $result = mysql_query($query, $this->db_link);
        return $result;
    }

    public function CreateUser($name) {
        $newUserID = "SELECT max(userid) FROM userdetail";
        $result = mysql_query($newUserID);
        $row = mysql_fetch_array($result);
        $userID = $row[0] + 1;
        $i = 1;
        do {
            $username = substr($name, 0, $i) . $userID;
            $i++;
            $userExist = $this->IsUserNameExist($username);
        } while ($userExist);
        return $username;
    }

    /**
     * Check wheter the User Exist or not
     * @param $username Username of the user.
     * @return boolean True if user exist and false in otherwise.
     */
    public function IsUserNameExist($username) {
        $query = "SELECT username FROM userdetail WHERE username='" . $username . "'";
        $result = mysql_query($query);
        if (!$result) {
            Logger::LogInformation("IsUserExist()## Query isn't executed, Error: " . mysql_error());
            return false;
        }
        if (mysql_num_rows($result) < 1)
            return false;
        return true;
    }

    public function GetUserNameByAccountType($accountType) {
        $query = "SELECT userid,name FROM userdetail UD,accountgroup AG WHERE AG.groupname='$accountType' AND AG.groupid=UD.groupid";
        $result = mysql_query($query);
        if (!$result) {
            Logger::LogInformation("GetNameByAccountType()## Query isn't executed for column type '$accountType', Error: " . mysql_error());
            return $result;
        }
        $returnValue = array();
        $i = 0;
        return $result;
        while ($row = mysql_fetch_array($result)) {
            $returnValue[$i] = array();
            array_push($returnValue[$i], $row[0]);
            array_push($returnValue[$i], $row[1]);
            $i++;
        }

        return $returnValue;
    }

    /**
     *
     * @param $id Id of User
     * @return MySQL_Resource SQL Resource if query executes otherwise false
     */
    public function GetUserDetail($id) {
        $returnValue = array();
        //$query = "select * from (select * from userdetail NATURAL JOIN roles NATURAL JOIN accountgroup "."Where userdetail.userid=$id ) as S1 NATURAL LEFT OUTER JOIN patient P ";
        $query = "SELECT * FROM (SELECT * FROM userdetail NATURAL JOIN ROLES NATURAL JOIN accountgroup AG Where userdetail.userid=$id)"
                . "AS S1 NATURAL LEFT OUTER JOIN(SELECT p.userid,UDForDoctor.name AS doctorname,UDForNurse.name AS nursename FROM patient P"
                . " LEFT JOIN userdetail UDForDoctor ON UDForDoctor.userid=P.doctorid LEFT JOIN userdetail UDForNurse ON UDForNurse.userid=P.nurseid) "
                . "AS S2 Natural left outer join Patient";
        $result = mysql_query($query);
        if (!$result) {
            Logger::LogInformation("GetUserDetail()## Query isn't executed, Error" . mysql_error());
            $returnValue[0] = 0;
        } else {
            Logger::LogInformation("GetUserDetail()## User Detail Loaded" . mysql_error());
            while ($row = mysql_fetch_array($result)) {
                array_push($returnValue, $row['name']);
                array_push($returnValue, $row['username']);
                array_push($returnValue, $row['role']);
                array_push($returnValue, $row['roleid']);
                array_push($returnValue, $row['groupname']);
                array_push($returnValue, $row['groupid']);
                array_push($returnValue, $row['creationdate']);
                array_push($returnValue, $row['street']);
                array_push($returnValue, $row['state']);
                array_push($returnValue, $row['city']);
                array_push($returnValue, $row['birthdate']);
                array_push($returnValue, $row['phoneno']);
                if ($row['role'] == 'Patient') {
                    array_push($returnValue, $row['doctorname']);
                    array_push($returnValue, $row['doctorid']);
                    array_push($returnValue, $row['nursename']);
                    array_push($returnValue, $row['nurseid']);
                    array_push($returnValue, $row['purposeofvisit']);
                    array_push($returnValue, $row['diagnosis']);
                    array_push($returnValue, $row['medication']);
                    array_push($returnValue, $row['lastvisit']);
                }
                else
                    array_push($returnValue, 0);
            }
        }
        return $returnValue;
    }

    public function SearchRecord($userID, $userName, $creationDate, $roleID, $accountGroupID, $name, $state, $city, $phoneno, $birthDate) {
        Logger::LogInformation("SearchRecord()## Search Started !!!");
        $query = "SELECT userid,name,role,groupname FROM userdetail NATURAL JOIN roles NATURAL JOIN accountgroup WHERE username LIKE '%$userName%' AND "
                . "creationdate LIKE '%$creationDate%' AND roleid LIKE '%$roleID%' AND groupid LIKE '%$accountGroupID%' AND "
                . "name LIKE '%$name%' AND state LIKE '%$state%' AND city LIKE '%$city%' AND phoneno LIKE '%$phoneno%' AND "
                . "birthdate LIKE '%$birthDate%' AND userid LIKE '%$userID%' AND roleid>" . $_SESSION['roleid'];
        $result = mysql_query($query);
        $returnValue = array();
        $returnValue[0] = 0;
        if (!$result) {
            Logger::LogInformation("SearchRecord()## Search failed, Error" . mysql_error());
            return $returnValue;
        }
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $returnValue[$i] = array();
            array_push($returnValue[$i], $row['userid']);
            array_push($returnValue[$i], $row['name']);
            array_push($returnValue[$i], $row['role']);
            array_push($returnValue[$i], $row['groupname']);
            $i++;
        }
        Logger::LogInformation("SearchRecord()## Search Completed !!!");
        
        return $returnValue;
    }

    public function HasPermission($userID, $permissionID) {
        $query = "SELECT * FROM permission NATURAL JOIN userpermission WHERE userid='$userID' AND permissionid='$permissionID'";
        $result = mysql_query($query);
        if (!$result) {
            Logger::LogInformation("HasPermission()## Query isn't executed, Error: " . mysql_error());
            return false;
        }
        if (mysql_fetch_row($result) > 0) {
            return true;
        }
        Logger::LogInformation("HasPermission()## User don't have permission for activityID =" . $permissionID);
        return false;
    }

    public function UpdateUserDetail($userID, $username, $name, $street, $city, $state, $phoneno, $birthdate, $creationdate, $roleid, $groupid, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication) {
        $query = "UPDATE userdetail set name='$name', street=\"$street\", city=\"$city\", phoneno='$phoneno', creationdate='$creationdate', roleid='$roleid', groupid='$groupid',birthdate='$birthdate',state='$state' WHERE userid='$userID'";
        $result = array();
        $result[0] = mysql_query($query, $this->db_link);
//        Logger::LogInformation("UpdateUserDetail()## Row effected: " . mysql_affected_rows());
//        Logger::LogInformation("UpdateUserDetail()## Query is: " . $query);
        if (!$result[0]) {
            Logger::LogInformation("UpdateUserDetail()## Query isn't executed, Error: " . mysql_error());
            $result[0] = false;
            $result[1] = mysql_error();
        } else if ($roleid == 4)
            $result[0] = $this->UpdatePatientDetail($userID, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication);
        Logger::LogInformation("UpdateUserDetail()## $name's detail is Successfull Updated !!!");
        $result[0]=true;
        return $result;
    }

    private function UpdatePatientDetail($userID, $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication) {
        $query = "UPDATE patient set doctorid='$doctorID', nurseid='$nurseID',lastvisit='$lastVisit', purposeofvisit='$purposeOfVisit',diagnosis='$diagnosis', medication='$medication' WHERE userid='$userID'";
        $result = mysql_query($query);
        if (!$result) {
            Logger::LogInformation("UpdatePatient()## Patient Data isn't inserted, Error: " . mysql_error());
        }
        else
            Logger::LogInformation("UpdatePatient()## Patient data Updated");
        return $result;
    }

    public function PermissionList($userID) {
        $query = "SELECT permissionname, permissionid FROM userpermission NATURAL JOIN permission WHERE userid = $userID AND (permissionid=1 OR permissionid=2) ORDER BY permissionid";
        $returnValue = array();
        $result = mysql_query($query, $this->db_link);

        if (!$result) {
            Logger::LogInformation("PermissionList()## Query doesn't executed, Error: " . mysql_error());
            $returnValue[0] = 0;
            return $returnValue;
        }
        if(mysql_num_rows($result)==0)
        {
            Logger::LogInformation("PermissionList()## User doesn't have any special permission: " );
            $returnValue[0] = 0;
            return $returnValue;
        }
        $i=0;
        while ($row = mysql_fetch_array($result))
        {
            $returnValue[$i]=array();
            array_push($returnValue[$i], $row['permissionname']);
            array_push($returnValue[$i], $row['permissionid']);
            $i++;
        }
        Logger::LogInformation("PermissionList()## PermissionList Loaded Successfully");
        return $returnValue;
    }
    public function ChangeUsername($newUsername){
        $returnValue= array();
        if($this->IsUserNameExist($newUsername))
        {
            Logger::LogInformation("ChangeUsername()## Username Update Failed, Error: User Already Exist");
            $returnValue[0]=0;
            $returnValue[1]="User Already Exist";
            return $returnValue;
        }
        $query = "UPDATE userdetail SET username = '$newUsername' WHERE userid='".$_SESSION['userid']."'";
        $result = mysql_query($query);
        if(!$result)
        {
            Logger::LogInformation("ChangeUsername()## Username Update Failed, Error: ".mysql_error());
            $returnValue[0]=0;
            $returnValue[1]=  mysql_error();
            return $returnValue;
        }
        Logger::LogInformation("ChangeUsername()## Username Updated successfully");
        $returnValue[0]=1;
        return $returnValue;
    }
    
    public function ChangePassword($newPassword){
        $returnValue= array();
        $password = md5($newPassword);
        $query = "UPDATE userdetail SET password= '$password' WHERE userid='".$_SESSION['userid']."'";
        $result = mysql_query($query);
        if(!$result)
        {
            Logger::LogInformation("ChangePassword()## Password Update Failed, Error: ".mysql_error());
            $returnValue[0]=0;
            $returnValue[1]=  mysql_error();
            return $returnValue;
        }
        Logger::LogInformation("ChangePassword()## Password Updated successfully");
        $returnValue[0]=1;
        return $returnValue;
    }
    /**
     *
     * @param type $userID ID of user which is going to be deleted
     * @return Array contains the success/failure status
     */
    public function DeleteUser($userID){
        $query = "DELETE FROM userdetail WHERE userid=".$userID;
        Logger::LogInformation("DeleteUser()## Remove User process started...");
        $returnValue = array();
        $returnValue[0]=  mysql_query($query);
        if(!$returnValue[0]){
            Logger::LogInformation("DeleteUser()## User didn't deleted, Error: ".mysql_error());
            $returnValue[1]=  mysql_error();
            return $returnValue;
        }
        $query = "DELETE FROM userpermission WHERE userid=".$userID;
        $returnValue = array();
        $returnValue[0]=  mysql_query($query);
        if(!$returnValue[0]){
            Logger::LogInformation("DeleteUser()## Permissions didn't deleted, Error: ".mysql_error());
            $returnValue[1]=  mysql_error();
            return $returnValue;
        }
        Logger::LogInformation("DeleteUser()## User and their permissions are successfully removed ");
        $returnValue[0]=1;
        return $returnValue;
    }

}

$sql = new SqlConnection();
?>
