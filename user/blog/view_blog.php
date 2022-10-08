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
        echo "<th>IMAGE</th>";
        $db=new Database();
        $db=$db->connect();
        $c=$db->query(" select likes from blog_likes as bl  inner join blog as b on(bl.blog_id=b.id) inner join user as u on(bl.user_id=u.id) where bl.user_id='$id' and bl.blog_id='$blog_id'");
        $b=$c->fetch();
        $l=$db->query("select count(likes) as cnt from blog_likes as bl inner join blog as b on(b.id=bl.blog_id) where bl.blog_id='$blog_id' and likes=1;");
        $likes=$l->fetch();
        $di=$db->query("select count(dislikes) as cnt from blog_likes as bl inner join blog as b on(b.id=bl.blog_id) where bl.blog_id='$blog_id' and dislikes=1;");
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
                        echo "<td>".$dislikes['cnt']."DISLIKES ".$likes['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\" class=\"like\">LIKES</a></td>";
                    }
                    else
                    {
                        echo "<td>".$likes['cnt']."LIKES ".$dislikes['cnt']."<a href=\"dislike.php?id=".$blog_id."&user_id=".$id."\" class=\"dislike\">DISLIKES</a></td>";
                    }
                }
                else
                {
                    echo "<td>".$dislikes['cnt']."DISLIKES ".$likes['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\" class=\"like\">LIKES</a></td>";
                }
                echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" class="blob"></td>';
            }   
}
      echo "</tr>";
      echo "</table>";
      echo "<a href=\"blogs_page.php\" class=\"back\">BACK</a>"; 
?>