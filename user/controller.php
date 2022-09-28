<?php
include('../database/database.php');
include('../validation/validation.php');
session_start();
class User extends Validation
{
    public $data;
    public $obj;
    function __construct($p=null)
    {
        $this->data=$p;
        $db=new Database();
        $this->obj=$db->connect();
    }
    function signup()
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
                echo "<h1 class=\"head\">ACCOUNT CREATED SUCCESSFULLY</h1>";
            }
        }
    }
    function login()
    {
        $count=0;
        $_SESSION['error']=$this->validateEmail($this->data['UserName'],$this->data['UserPassword']);
        $username=$this->data['UserName'];
        $password=$this->data['UserPassword'];
        if(empty($_SESSION['error']))
        {
            $data=$this->obj->query("select *from user where email='$username' and password='$password' ");
            $s=$data->fetch();
            if($s)
            {
                if($s['status']==1)
                {
                        $count=0;
                        $_SESSION['usr_id']=$s['id'];
                        $_SESSION['login']['userstatus']=0;
                        $_SESSION['user_name']=$s['firstname'];
                        header('location:blog/blogs_page.php');
                    $count++;
                }
                else
                {
                        echo "<h1 class=\"head\">You are Inactive</h1>";
                        $count=0;
                }
                    $count++;
            }
            else
            {
                echo "<h1 class=\"head\">Wrong Credentials</h1>";
            }
        }
    }
}


?>