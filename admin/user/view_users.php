<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php
session_start(); 
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$obj=new User();
$d=$obj->view();
    echo "<table cellspacing=0>";
    echo "<th>ID</th>";
    echo "<th>FIRST NAME</th>";
    echo "<th>LAST NAME</th>";
    echo "<th>EMAIL</th>";
    echo "<th>EDIT</th>";
    echo "<th>DELETE</th>";
    echo "<th>ACTIVATE</th>";
    echo "<th>STATUS</th>";
    if($d)
    {
        foreach($d as $row)
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['firstname']."</td>";
            echo "<td>".$row['lastname']."</td>";
            echo "<td>".$row['email']."</td>";     
            echo "<td><a href=\"edit.php?id=".$row['id']."\">EDIT</a></td>";
            echo "<td><a href=\"delete.php?id=".$row['id']."\">DELETE</a></td>"; 
            if($row['status']==0)
            {
            echo "<td><a href=\"active.php?id=".$row['id']."\" class=\"active\">ACTIVATE</a></td>";
            }
            else
            {
            echo "<td><a href=\"inactive.php?id=".$row['id']."\" class=\"inactive\">INACTIVATE</a></td>";
            }  
            echo "<td>".$row['status']."</td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }
echo "<a href=\"../main_page.php\" class=\"back\">BACK</a>"; 
?>