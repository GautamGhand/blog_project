<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php 
session_start();
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$obj=new Blog();
$r=$obj->view();
echo "<table cellspacing=0>";
        echo "<th>ID</th>";
        echo "<th>TITLE</th>";
        echo "<th>DESCRIPTION</th>";
        echo "<th>DATE</th>";
        echo "<th>EDIT</th>";
        echo "<th>DELETE</th>";
        echo "<th>ACTIVATE</th>";
        echo "<th>STATUS</th>";
        echo "<th>IMAGE</th>";
        if($r)
        {
            foreach($r as $row)
            {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['description']."</td>" ; 
                echo "<td>".$row['date']."</td>";   
                echo "<td><a href=\"edit_blog.php?id=".$row['id']."\">EDIT</a></td>";
                echo "<td><a href=\"delete_blog.php?id=".$row['id']."\">DELETE</a></td>"; 
                if($row['status']==0)
                {
                    echo "<td><a href=\"active_blog.php?id=".$row['id']."\" class=\"active\">ACTIVATE</a></td>";
                }
                else
                {
                    echo "<td><a href=\"inactive_blog.php?id=".$row['id']."\" class=\"inactive\">INACTIVATE</a></td>";  
                }
                echo "<td>".$row['status']."</td>";
                echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" class="blob"></td>';
            }
                echo "</tr>";
                echo "</table>";  
        }
        echo "<a href=\"../main_page.php\" class=\"back\">BACK</a>";  
?>
