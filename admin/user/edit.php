<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php
session_start();
include('controller.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:../admin_login.php');
}
$id = $_GET['id'];
$obj = new PDO('mysql:dbname=blog_project;host=localhost;', 'root', '');
$data=$obj->query("select *from user where id='$id' ");
$row=$data->fetch();
if($row)
{
        $val = $row;
}
else
{
    header('location:view_users.php');
}
if(isset($_POST['Edit_User'])) 
{
    $obj=new User();
    $obj->edit('user',$id,$_POST);
}
?>
<html>

<head>
    <title>EDIT USER</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <label class="txt">FIRST NAME</label>
                <input type="text" name="firstname" class="inpt" value=<?php echo $val['firstname'] ?>>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['firstname']))
                    {
                        echo $_SESSION['error']['firstname'];
                    }
                    ?>
                </div>
                <label class="txt">LAST NAME</label>
                <input type="text" name="lastname" class="inpt" value=<?php echo $val['lastname'] ?>>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['lastname']))
                    {
                        echo $_SESSION['error']['lastname'];
                    }
                    ?>
                </div>
                <label class="txt">EMAIL</label>
                <input type="email" name="UserName" class="inpt" value=<?php echo $val['email'] ?>>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['email']))
                    {
                        echo $_SESSION['error']['email'];
                    }
                    ?>
                </div>
                <label class="txt">PASSWORD</label>
                <input type="text" name="UserPassword" class="inpt" value=<?php echo $val['password'] ?>>
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['password']))
                    {
                        echo $_SESSION['error']['password'];
                    }
                    ?>
                </div>
                <input type="submit" name="Edit_User" value="Edit User" class="btn">
            </form>
        </section>
    </section>
</body>

</html>