<?php 
class user{
    public $ID;
    public $username;
public $password;
public $type;
public $office;
    function __construct(){
       $this->ID= "";
        $this->username ="";
        $this->password = "";
        $this->type = "";
        $this->office = "";
    }
}
?>