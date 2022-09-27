<?php
session_start();
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id=$_GET['id'];
$db=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
$data=$db->query("select *from blog where id='$id' ");
$d=$data->fetch();
if($d)
{
    $db->exec("update blog set status=1 where id='$id' ");
    header('location:view_blogs.php');
}