<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php
session_start();
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id = $_GET['id'];
$db=new Database();
$obj=$db->connect();
$data=$obj->query("select *from blog where id='$id'");
$row=$data->fetch();
if($row)
{
    $val = $row;
}
else
{
    header('location:view_users.php');
}
if(isset($_POST['Edit_Blog'])) 
{
    $ad = new Blog($_POST);
    $ad->edit('blog',$id,$_POST);
}
?>
<html>

<head>
    <title>EDIT BLOG</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="edit_blog.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <label class="txt">TITLE</label>
                <input type="text" name="title" value=<?php echo $val['title'];?> class="inpt">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['title']))
                    {
                        echo $_SESSION['error']['title'];
                    }
                    ?>
                </div>
                <label class="txt">DESCRIPTION</label>
                <textarea name="description" class="desc"><?php echo $val['description']; ?></textarea>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['description']))
                    {
                        echo $_SESSION['error']['description'];
                    }
                    ?>
                </div>
                <input type="submit" name="Edit_Blog" value="Edit Blog" class="btn">
            </form>
        </section>
    </section>
</body>

</html>