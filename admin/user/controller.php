<?php
include('../../database/database.php');
include('../../validation/validation.php');
include('../../commontraits/controller_common.php');
class User extends Validation
{
    use common;
    public $data;
    public $obj;
    function __construct($p=null)
    {
        $this->data=$p;
        $db=new Database();
        $this->obj=$db->connect();
    }
    function create()
    {
        $_SESSION['error']=$this->validateName($this->data);
        $_SESSION['error']=$this->validateEmailExists($this->data['UserName'],$this->obj);
        $_SESSION['error']=$this->validateEmail($this->data['UserName'],$this->data['UserPassword']);
        if(empty($_SESSION['error']))
        {
            $fname=$this->data['firstname'];
            $lname=$this->data['lastname'];
            $email=$this->data['UserName'];
            $password=$this->data['UserPassword'];
            if($this->obj->exec("insert into user(firstname,lastname,email,password) values('$fname','$lname','$email','$password')"))
            {
                echo "<h1 class=\"head\">USERCREATED SUCCESSFULLY</h1>";
            }
        }
    }
    function view()
    {
        $data=$this->obj->query("select *from user");
        $s=$data->fetchAll();
        return $s;
    }
}


?>