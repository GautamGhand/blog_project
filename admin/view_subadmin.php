<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php 
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
$obj=new Admin();
$d=$obj->view();
    echo "<table cellspacing=0>";
    echo "<th>EMAIL</th>";
    echo "<th>PASSWORD</th>";
if($d)
{
    if($_SESSION['login']['role']==1)
    {
        echo "<th>DELETE</th>";
    }
    foreach($d as $row)
    {
        if($_SESSION['login']['role']==1)
        {
        echo "<tr>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "<td><a href=\"delete_subadmin.php?id=".$row['id']."\" class=\"active\">DELETE</a></td>";
        }
        else 
        {
            if($row['role']==1)
            {
                continue;
            }
            echo "<tr>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['password']."</td>";
        }
    } 
}
echo "<a href=\"main_page.php\" class=\"back\">BACK</a>";
?>