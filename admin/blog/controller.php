<?php
include("../../database/database.php");
include('../../validation/validation.php');
include('../../commontraits/controller_common.php');
class Blog extends Validation
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
    function create()
    {
        $_SESSION['error']=$this->validateBlog($this->data);
        if(empty($_SESSION['error']))
        {
            $title=$this->data['title'];
            $description=$this->data['description'];
            $cnt=$this->obj->exec("insert into blog(title,description) values('$title','$description')");
            if($cnt>=1)
            {
                header('location:view_blogs.php');
            }
        }      
    }
    function view()
    {
        $data=$this->obj->query("select *from blog");
        $d=$data->fetchAll();
        return $d;          
    }
}
?>