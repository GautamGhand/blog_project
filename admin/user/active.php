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
$data=$db->query("select *from user where id='$id' ");
$d=$data->fetch();
if($d)
{
        $db->exec("update user set status=1 where id='$id' ");
        header('location:view_users.php');
}
?>