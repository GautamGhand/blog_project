<?php 
include('../class.php');
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:user_login.php');
}
$blog_id=$_GET['blog_id'];
$obj=new User();
$obj->view_blog($blog_id);
?>