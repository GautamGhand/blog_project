<?php
include('../user/controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id=$_GET['id'];
$obj=new User();
$obj->delete('user',$id);
?>