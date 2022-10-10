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
        $c=$db->query("select *,(select count(likes) from blog_likes where likes=1) as cnt,(select count(dislikes)from blog_likes where dislikes=1) as dcnt,(select likes from blog_likes where likes=1 and blog_id='$blog_id' and user_id='$id') as likeu from blog as b inner join blog_likes as bl on(b.id=bl.blog_id) where b.id='$blog_id'");
        $b=$c->fetch();
        if($row['status']==1)
            {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['description']."</td>" ;
                if(isset($b['likeu']))
                {
                    if($b['likeu']==1)
                    {
                        echo "<td>".$b['cnt']."LIKES ".$b['dcnt']."<a href=\"dislike.php?id=".$blog_id."&user_id=".$id."\" class=\"dislike\">DISLIKES</a></td>";

                    }
                    else
                    {
                        echo "<td>".$b['dcnt']."DISLIKES ".$b['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\" class=\"like\">LIKES</a></td>";
                    }
                }
                else
                {
                    echo "<td>".$b['dcnt']."DISLIKES ".$b['cnt']."<a href=\"like.php?id=".$blog_id."&user_id=".$id."\" class=\"like\">LIKES</a></td>";   
                }
                echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" class="blob"></td>';
            }   
}
      echo "</tr>";
      echo "</table>";
      echo "<a href=\"blogs_page.php\" class=\"back\">BACK</a>"; 
?>