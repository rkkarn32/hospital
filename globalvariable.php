<?php

class PermissionByID {

    static public $ALA = array();
    static public $LLA = array();
    static public $reportData=1;
    static public $retrieveData=2;
    static public $createUser=3;
    
    static function Initialization() {
        PermissionByID::$ALA = array(1,2,3);
        PermissionByID::$LLA = array(3);
    }
}
PermissionByID::Initialization();

class Roles{
    static public $root=1;
    static public $ALA=2;
    static public $LLA=3;
    static public $patient=4;
}
?>
