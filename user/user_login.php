<?php
include('controller.php');
if (isset($_POST['submit']))
{
    $obj = new User($_POST);
    $obj->login();
}
?>
<html>

<head>
    <title>USER LOGIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <section class="container">
        <H1 class="heading">USER LOGIN PAGE</H1>
        <section class="frm">
            <form action="user_login.php" method="POST">
                <label class="txt">USERNAME</label>
                <input type="email" name="UserName" class="inpt">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['email']))
                    {
                        echo $_SESSION['error']['email'];
                    }
                    ?>
                </div>
                <label class="txt">PASSWORD</label>
                <input type="password" name="UserPassword" class="inpt">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['password']))
                    {
                        echo $_SESSION['error']['password'];
                           unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <input type="submit" value="SUBMIT" name="submit" class="btn">
            </form>
        </section>
        <div class="d">
        <a href="../admin/admin_login.php" class="lgn">I AM ADMIN</a>
        <a href="../user/user_signup.php" class="lgn">USER SIGNUP</a>
        </div>  
    </section>
</body>

</html>
