<?php 
include('controller.php');
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:../user_login.php');
}
$id=$_SESSION['usr_id'];
$blog_id=$_GET['blog_id'];
$obj=new Blog();
$row=$obj->view_blog($blog_id);
if($row)
{
        echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>LIKE</th>";
        $db=new Database();
        $db=$db->connect();
        $c=$db->query("select likes from blog_likes where user_id='$id' and blog_id='$blog_id'");
        $b=$c->fetch();
        $l=$db->query("select count(likes) as cnt from blog_likes where blog_id='$blog_id' and likes=1 ");
        $likes=$l->fetch();
        $di=$db->query("select count(dislikes) as cnt from blog_likes where blog_id='$blog_id' and dislikes=1");
        $dislikes=$di->fetch();
            if($row['status']==1)
            {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['description']."</td>" ;
                if($b)
                {
                    if($b['likes']==0)
                    {
                        echo "<td>".$likes['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\">LIKE</a></td>";
                    }
                    else
                    {
                        echo "<td>".$dislikes['cnt']."<a href=\"dislike.php?id=".$blog_id."&user_id=".$id."\">DISLIKE</a></td>";
                    }
                }
                else
                {
                    echo "<td>".$likes['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\">LIKE</a></td>";
                }
            }   
}
      echo "</tr>";
      echo "</table>";
      echo "<a href=\"blogs_page.php\" class=\"back\">BACK</a>"; 
?>