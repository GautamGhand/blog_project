<?php
include('../database/database.php');
include('../validation/validation.php');
include('../commontraits/controller_common.php');
session_start();
class Admin extends Validation
{   
    use common;
    public $data;
    public $obj;
    function __construct($data=null)
    {
        $this->data=$data;
        $db=new Database();
        $this->obj=$db->connect();
    }
    function login()
    {
        $_SESSION['error']=$this->validateEmail($this->data['admin_email'],$this->data['admin_password']);
        $admin_username=$this->data['admin_email'];
        $admin_password=$this->data['admin_password'];
        if(empty($_SESSION['error']))
        {
            $data=$this->obj->query("select *from admin where email='$admin_username' and password='$admin_password' ");
            $s=$data->fetch();
            if($s)
            {
                    $_SESSION['login']=$s;
                    $_SESSION['login']['status']=0;
                    header('location:main_page.php');
            }
            else
            {
                echo "<h1 class=\"head\">WRONG CREDENTIALS</h1>";
            }
        }
    }   
    function create()
    {
        $_SESSION['error']=$this->validateEmail($this->data['admin_email'],$this->data['admin_password']);
        if(empty($_SESSION['error']))
        {
            $email=$this->data['admin_email'];
            $password=$this->data['admin_password'];
            $cnt=$this->obj->exec("insert into admin(email,password,role) values('$email','$password',2)");
            if($cnt>=1)
            {
                echo "<h1 class=\"head\">SUB ADMIN CREATED SUCCESSFULLY</h1>";
            }
        }
    }
    function view()
    {
       
        $data=$this->obj->query("Select *from admin where role=2");
        $d=$data->fetchAll();
        return $d;
    }
   
}
?>