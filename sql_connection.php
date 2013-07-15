<?php
include_once 'logger.php';
$sql = new SqlConnection();
class SqlConnection{
    private $db_name = "hospital";
    private $db_link;
    private $sql_username = "root";
    private $sql_password="";
    
    
    private $userid;
    private $username;
    private $roleid;
    public function __construct() {
        $this->db_link = mysql_connect("localhost",$this->sql_username,$this->sql_password);			// Database connection
        if(!$this->db_link)
        {
            Logger::LogInformation("MySQL connection problem, Error: ".mysql_error());
            die('MySQL not connected, Error:'.mysql_error());
        }
        $db_selected = mysql_select_db($this->db_name,$this->db_link);
        if(!$db_selected)
        {
            Logger::LogInformation("Database not connected, Error: ".mysql_error());
            die('Database not selected, Error: '.myslq_error());
        }
    }
    
    public function LoginVerification($uname,$pword){
        $sql = "SELECT * FROM userdetail WHERE username = '".  mysql_escape_string($uname)."' AND password ='".  mysql_escape_string($pword)."'";
        $result = mysql_query($sql, $this->db_link);
        if(!$result)
            Logger::LogInformation ("LoginVerification()## Query isn't executed, Error: ".mysql_error ());
        while($row = mysql_fetch_array($result) ){
            $this->userid = $row['userid'];
            $_SESSION['loggedin'] = 1;  
            $_SESSION['userid']= $this->userid;
            $_SESSION['roleid']=$row['roleid'];
            Logger::LogInformation("Successfully Logged In by User:".$row['name']);
            return 1;
        }
        return 0;
    }
    
    function LoadAllUser(){
        $allUser = array();
        $allUser[0][0]=0;
        
        $sql = "SELECT userid,name,role,groupname FROM userdetail UD,roles R,accountgroup AG WHERE UD.roleid > "
                .$_SESSION['roleid']." AND UD.roleid=R.roleid AND UD.accountgroupid=AG.groupid";
//        $sql = "SELECT userid,name FROM userdetail";
        $result = mysql_query($sql,$this->db_link );
        if(!$result){
            Logger::LogInformation("LoadAllUser()## Query isn't executed, Error: ".mysql_error());
            return $allUser;
        }
        Logger::LogInformation("LoadAllUser(), User List loaded Successfully");
        $i = 0;
        $allUser[0][0]=0;
        while($row = mysql_fetch_array($result)){
            $allUser[$i] = array();
            array_push($allUser[$i], $row[0]);
            array_push($allUser[$i], $row[1]);
            array_push($allUser[$i], $row[2]);
            array_push($allUser[$i], $row[3]);
            
            $i++;
        }
        return $allUser;
    }

    public function RegisterUser($username,$password,$name,$street,$city,$state,$phoneno,$birthdate,$creationdate,$roleid,$accountgroupid,$doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication){
	$query = "insert into userdetail set username='$username', password='$password', name='$name', street='$street', city='$city', phoneno='$phoneno', creationdate='$creationdate', roleid='$roleid', accountgroupid='$accountgroupid',birthdate='$birthdate',state='$state' ";
        $result = array();
	$result[0] = mysql_query($query,$this->db_link);
        if(!$result[0]){
            Logger::LogInformation("RegisterUser()## Query isn't executed, Error: ".mysql_error());
            $result[0]= false;
        }
        else if($roleid ==4)
            $result[0] = $this->RegisterPatient( $doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication);
        else
            Logger::LogInformation("RegisterUser(), Registration for $name is Successfull");
        return $result;
    }
    
    private function RegisterPatient($doctorID, $nurseID, $lastVisit, $purposeOfVisit, $diagnosis, $medication ){
        $queryUserID = "SELECT max(userid) FROM userdetail";
        $resultUserID = mysql_query($queryUserID);
        $row = mysql_fetch_array($resultUserID);
        $userid = $row[0];
        $query = "INSERT INTO patient VALUES ('','$userid','$doctorID','$nurseID','$lastVisit','$purposeOfVisit','$diagnosis','$medication')";
        $result = mysql_query($query);
        if(!$result)
        {
            Logger::LogInformation ("RegisterPatient()## Query is ".  $query);
            Logger::LogInformation ("RegisterPatient()## Data isn't inserted, Error: ".  mysql_error());
        }
        else
            Logger::LogInformation ("RegisterPatient()## Patient data inserted");
        return $result;
    }
    
    /**
     *Returns the all Roles who is lower privilege than current user.
     * @param $uID is ID of current user
     * @return Array It returns the array of roles.
     */
    public function GetRoles($uID){
        //$sql = "SELECT * FROM roles WHERE roleid>".$uID;
        $sql = "SELECT * FROM roles WHERE roleid>".$_SESSION['roleid'];
        $result = mysql_query($sql,$this->db_link);
        if(!$result){
            Logger::LogInformation("GetRoles## Query isn't executed, Error:". mysql_error());
        }
        $roleList = array();
        $i=0;
        while($row = mysql_fetch_array($result)){
            $roleList[$i] = array();
            array_push($roleList[$i], $row[0]);
            array_push($roleList[$i], $row[1]);
            $i++;
        }
        return $roleList;
    }
    
    public function GetAccountList(){
        $sql = "SELECT * FROM accountgroup";
        $result = mysql_query($sql,$this->db_link);
        if(!$result){
            Logger::LogInformation("GetAccountList()## Query isn't executed, Error: ".  mysql_error());
        }
        $accountList = array();
        $i=0;
        while($row= mysql_fetch_array($result)){
            $accountList[$i]= array();
            array_push($accountList[$i], $row[0]);
            array_push($accountList[$i], $row[1]);
            $i++;
        }
        return $accountList;
    }
    public function ExecuteQuery($query){
        $result = mysql_query($query,$this->db_link);
        return $result;
    }
    public function CreateUser($name){
        $newUserID = "SELECT max(userid) FROM userdetail";
        $result= mysql_query($newUserID);
        $row = mysql_fetch_array($result);
        $userID = $row[0]+1;
        $i=1;
        do{
            $username = substr($name, 0,$i). $userID;
            $i++;
            $userExist = $this->IsUserExist($username);
        }while($userExist);
        return $username;
    }
    private function IsUserExist($username){
        $query = "SELECT username FROM userdetail WHERE username='".$username."'";
        $result = mysql_query($query);
        if(!result)
        {
            Logger::LogInformation ("IsUserExist()## Query isn't executed, Error: ".mysql_error ());
            return false;
        }
        if(mysql_num_rows($result)<1)
            return false;
        return true;
    }
    
    public function GetUserNameByAccountType($accountType){
        $query = "SELECT userid,name FROM userdetail UD,accountgroup AG WHERE AG.groupname='$accountType' AND AG.groupid=UD.accountgroupid";
        $result = mysql_query($query);
        if(!$result){
            Logger::LogInformation("GetNameByAccountType()## Query isn't executed for column type '$accountType', Error: ".mysql_error());
            return $result;
        }
        $returnValue = array();
        $i=0;
        return $result;
        while($row = mysql_fetch_array($result)){
            $returnValue[$i]= array();
            array_push($returnValue[$i], $row[0]);
            array_push($returnValue[$i], $row[1]);
            $i++;
        }
        
        return $returnValue ;
    }
    
    public function GetUserByID($id){
        $query = "SELECT userid,name,role,groupname FROM userdetail UD,roles R,accountgroup AG WHERE UD.roleid > "
                .$_SESSION['roleid']." AND UD.roleid=R.roleid AND UD.accountgroupid=AG.groupid";
    }


    public function User($id){
		$sql="select * from  userdetail where userid ='$id'";
		$result = mysql_query($sql);
		$user= mysql_fetch_array($result);
		return $user;
		
	}
	public function type($id){
		$sql="select * from roles where roleid ='$id'";
		$result = mysql_query($sql);
		$user= mysql_fetch_array($result);
		return $user;
		
	}
	public function group($id){
		$sql="select * from accountgroup where groupid ='$id'";
		$result = mysql_query($sql);
		$user= mysql_fetch_array($result);
		return $user;
		
	}
    
}
?>
