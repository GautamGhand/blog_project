<?php 
session_start();
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
?>
<html>

<head>
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <h1 class="heading">ADMIN PANEL</h1>
    <section class="panel_up">
        <section class="panel_inside">
            <a href="create_user.php" class="link">CREATE USER</a>
            <a href="view_users.php" class="link">VIEW USERS</a>
            <a href="create_blog.php" class="link">CREATE BLOG</a>
            <a href="view_blogs.php" class="link">VIEW BLOGS</a>
            <a href="create_subadmin.php" class="link">CREATE SUB-ADMIN</a>
            <a href="view_subadmin.php" class="link">VIEW SUB-ADMIN</a>
            <a href="logout_admin.php" class="link">LOGOUT</a>
        </section>
    </section>
</body>

</html>