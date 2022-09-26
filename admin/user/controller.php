<?php
include('../../database/database.php');
include('../../validation/validation.php');
include('../../commontraits/controller_common.php');
class User extends Database
{
    use common;
    public $data;
    public $obj;
    public $valid;
    function __construct($p=null)
    {
        $this->data=$p;
        $this->obj=parent::connect();
        $this->valid=new Validation();
    }
    function create()
    {
        $_SESSION['error']=$this->valid->validateName($this->data);
        $_SESSION['error']=$this->valid->validateEmailExists($this->data['UserName'],$this->obj);
        $_SESSION['error']=$this->valid->validateEmail($this->data['UserName'],$this->data['UserPassword']);
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
    // function edit($id)
    // {
    //     $data=$this->obj->query("select *from user where id='$id' ");
    //     $s=$data->fetch();
    //         if($s)
    //         {
    //             $name=$this->data['UserName'];
    //             $password=$this->data['UserPassword'];
    //             $this->obj->exec("update user set email='$name',password='$password' where id='$id' ");
    //             header('location:view_users.php');              
    //         }
    // }
    // function delete($id)
    // {
    //     $data=$this->obj->query("select *from user where id='$id'");
    //     $s=$data->fetch();
    //         if($s)
    //         {
    //             $this->obj->exec("delete from user where id='$id'");
    //             $this->obj->exec("alter table user AUTO_INCREMENT=1");
    //             header('location:view_users.php');
    //         }    
    // }
    
}


?>