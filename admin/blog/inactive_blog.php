<?php
session_start();
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id=$_GET['id'];
$db=new Database();
$db=$db->connect();
$data=$db->query("select *from blog");
$d=$data->fetch();
if($d)
{
        $db->exec("update blog set status=0 where id='$id' ");
        header('location:view_blogs.php');
}