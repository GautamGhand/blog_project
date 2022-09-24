<?php
include('../class.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
$id=$_GET['id'];
$obj=new Admin();
$obj->delete($id);
?>