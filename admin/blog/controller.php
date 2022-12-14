<?php
include("../../database/database.php");
include('../../validation/validation.php');
include('../../commontraits/controller_common.php');
class Blog extends Validation
{
    use common;
    public $data;
    public $obj;
    public $file;
    function __construct($data=null,$file=null)
    {
        $this->data=$data;
        $db=new Database();
        $this->obj=$db->connect();
        $this->file=$file;
    }
    function create()
    {
        $_SESSION['error']=$this->validateBlog($this->data,$this->file);
        if(empty($_SESSION['error']))
        {
            $title=$this->data['title'];
            $description=$this->data['description'];
            $image=addslashes(file_get_contents($_FILES['file']['tmp_name']));
            $cnt=$this->obj->exec("insert into blog(title,description,image) values('$title','$description','$image')");
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