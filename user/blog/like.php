<?php 
session_start();
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:../user_login.php');
}
$id=$_GET['id'];
$user_id=$_GET['user_id'];
$db=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
$data=$db->query("select * from blog_likes where blog_id='$id' and user_id='$user_id' ");
$d=$data->fetchAll();
if(!$d)
{
    $db->exec("insert into blog_likes(blog_id,likes,user_id) values('$id',1,'$user_id')");
    $_SESSION['blog_id']=$id;
    header('location:view_blog.php?blog_id='.$id);
}
else
{
        $db->exec("update blog_likes set likes=1,dislikes=0 where blog_id='$id' and user_id='$user_id'");
        $_SESSION['blog_id']=$id;
        header('location:view_blog.php?blog_id='.$id);
}
?>