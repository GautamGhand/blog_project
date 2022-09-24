<?php
include('../class.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
$id = $_GET['id'];
$obj = new PDO('mysql:dbname=blog_project;host=localhost;', 'root', '');
foreach ($obj->query("select *from user") as $row) {
    if ($id == $row['id']) {
        $val = $row;
    }
}
if (isset($_POST['Edit_User'])) {
    $ad = new Admin($_POST);
    $ad->edit($id);
    header('location:view_users.php');
}
?>
<html>

<head>
    <title>CREATE USER</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <label class="txt">EMAIL</label>
                <input type="email" name="UserName" class="inpt" value=<?php echo $val['email'] ?>>
                <label class="txt">PASSWORD</label>
                <input type="text" name="UserPassword" class="inpt" value=<?php echo $val['password'] ?>>
                <input type="submit" name="Edit_User" value="Edit User" class="btn">
            </form>
        </section>
    </section>
</body>

</html>