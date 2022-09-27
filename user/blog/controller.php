<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php 
include('../../database/database.php');
include('../../validation/validation.php');
session_start();
class Blog extends Validation
{
    public $obj;
    function __construct()
    {
        $db=new Database();
        $this->obj=$db->connect();
    }
    function view()
    {
        $data=$this->obj->query("Select *from blog");
        $d=$data->fetchAll();
        return $d;
    }
    function view_blog($id)
    {
        $v=$this->obj->query("select *from blog where id='$id'");
        $x=$v->fetch();
        if($x==false)
        {
            header('location:blogs_page.php');
        }
        return $x;
        
    }
}
?>