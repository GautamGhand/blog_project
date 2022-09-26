<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php 
include('controller.php');
session_start();
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
if(isset($_POST['submit']))
{
    $obj=new Blog($_POST);
    $obj->create();
}
?>

<html>
    <head>
        <title>CREATE BLOG</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <section class="container">
            <section class="frm">
                <form action="create_blog.php" method="POST">
                <label class="txt">TITLE</label>
                <input type="text" class="inpt" name="title">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['title']))
                    {
                        echo $_SESSION['error']['title'];
                    }
                    ?>
                </div>
                <label class="txt">DESCRIPTION</label>
                <textarea name="description" class="desc" rows=7 cols="5"></textarea>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['description']))
                    {
                        echo $_SESSION['error']['description'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <input type="submit" valiue="Create Blog" name="submit" class="btn">
                </form>
            </section>
        </section>
        <a href="../main_page.php" class="link">BACK</a>
    </body>
</html>