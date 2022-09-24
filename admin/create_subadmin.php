<?php
include('../class.php');
if(!isset($_SESSION['login']['status']))
{
    header('location:admin_login.php');
}
if (isset($_POST['Create_subadmin'])) {
    $obj = new Subadmin($_POST);
    $obj->create();
}
?>
<html>

<head>
    <title>CREATE SUB-ADMIN</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="create_subadmin.php" method="POST">
                <label class="txt">EMAIL</label>
                <input type="text" name="SadminEmail" class="inpt">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['email']))
                    {
                        echo $_SESSION['error']['email'];
                    }
                    ?>
                </div>
                <label class="txt">PASSWORD</label>
                <input type="password" name="SadminPassword" class="inpt">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['password']))
                    {
                        echo $_SESSION['error']['password'];
                           unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <input type="submit" name="Create_subadmin" value="Create Sub-Admin" class="btn">
            </form>
        </section>
    </section>
</body>

</html>
<?php
echo "<a href=\"main_page.php\" class=\"active\">BACK</a>";  
?>