<?php
include('controller.php');
if(!isset($_SESSION['login']['userstatus']))
{
    header('location:../user_login.php');
}
$obj=new Blog();
$d=$obj->view();
echo "<table cellspacing=0>";
echo "<th>ID</th>";
echo "<th>TITLE</th>";
echo "<th>DESCRIPTION</th>";
echo "<th>VIEW</th>";
if($d)
{
    foreach($d as $row)
    {
        if($row['status']==1)
        {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['description']."</td>" ;
        echo "<td><a href=\"view_blog.php?blog_id=".$row['id']."\">VIEW</a></td>";
        }
    }
    echo "</tr>";
    echo "</table>";
}
else
{
    echo "<h1 class=\"heading\">NO RECORD FOUND</h1>";
}
echo "<a href=\"../user_logout.php\" class=\"back\">LOGOUT</a>"; 
?>