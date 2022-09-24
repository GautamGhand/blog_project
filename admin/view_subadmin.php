<?php 
include('../class.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
$obj=new Subadmin();
$obj->view();
?>