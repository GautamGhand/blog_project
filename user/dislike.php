<?php 
session_start();
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:user_login.php');
}
$id=$_GET['id'];
$user_id=$_GET['user_id'];
$db=new PDO('mysql:dbname=blog_project;host=localhost;','root','');
$count =0;
$data=$db->query("select *from blog_likes");
$d=$data->fetchAll();
if($d==false)
{
    $db->exec("insert into blog_likes(blog_id,dislikes,user_id) values('$id',1,'$user_id')");
    $_SESSION['blog_id']=$id;
    header('location:../user/view_blog.php?blog_id='.$id);
}
else{
foreach($db->query("select blog_id,dislikes,user_id from blog_likes") as $row)
{
    if($row['user_id']==$user_id && $row['blog_id']==$id)
    {
        $count=0;
        break;
    }
    else
    {
      $count++;
    }
}
if($count==0)
{
    $db->exec("update blog_likes set dislikes=1,likes=0 where blog_id='$id' and user_id='$user_id' ");
    $_SESSION['blog_id']=$id;
    header('location:../user/view_blog.php?blog_id='.$id);
}
else
{
    $db->exec("insert into blog_likes(blog_id,dislikes,user_id) values('$id',1,'$user_id')");
    header('location:../user/view_blog.php?blog_id='.$id);
}
}
?>