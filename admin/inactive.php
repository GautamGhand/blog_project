<?php
$id=$_GET['id'];
$db=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
foreach($db->query("select *from user") as $row)
{
    if($id==$row['id'])
    {
        $db->exec("update user set status=0 where id='$id' ");
        header('location:view_users.php');
    }
}