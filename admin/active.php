<?php
session_start();
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
$id=$_GET['id'];
$db=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
foreach($db->query("select *from user") as $row)
{
    if($id==$row['id'])
    {
        $db->exec("update user set status=1 where id='$id' ");
        header('location:view_users.php');
    }
}
?>