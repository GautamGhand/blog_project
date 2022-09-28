<?php
include('controller.php');
session_start();
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id=$_GET['id'];
$obj=new Blog();
$obj->delete('blog',$id);
?>