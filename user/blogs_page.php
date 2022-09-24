<?php
include('../class.php');
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:user_login.php');
}
$obj=new User();
$obj->view();
?>