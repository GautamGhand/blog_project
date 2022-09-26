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
$db=new Database();
$db=$db->connect();
if($row)
{
echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>LIKE</th>";
        $c=$db->query("select likes from blog_likes where user_id='$id' and blog_id='$blog_id'");
        $b=$c->fetch();
            if($row['status']==1)
            {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['description']."</td>" ;
                if($b==true)
                {
                    if($b['likes']==0)
                    {
                        echo "<td><a href=\"like.php?id=".$blog_id."&user_id=".$id."\">LIKE</a></td>";
                    }
                    else
                    {
                        echo "<td><a href=\"dislike.php?id=".$blog_id."&user_id=".$id."\">DISLIKE</a></td>";
                    }
                }
                else
                {
                    echo "<td>";
                    echo "<a href=\"like.php?id=".$blog_id."&user_id=".$id."\">LIKE</a></td>";
                }
            }   
      }
      echo "</tr>";
      echo "</table>";
      echo "<a href=\"blogs_page.php\" class=\"active\">BACK</a>"; 
?>