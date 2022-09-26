<?php
include('controller.php');
if (isset($_POST['submit'])) 
{
    $obj = new Admin($_POST);
    $obj->login();
}
?>
<html>

<head>
    <title>ADMIN LOGIN PAGE</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">

<body>
    <section class="container">
        <h1 class="heading">ADMIN LOGIN PAGE</h1>
        <section class="frm">
            <form action="admin_login.php" method="POST">
                <label class="txt">USERNAME</label>
                <input type="email" name="admin_email" class="inpt">
                <div class="error">
                    <?php
                        if(!empty($_SESSION['error']['email']))
                        {
                            echo $_SESSION['error']['email'];
                        }
                    ?>
                </div>
                <label class="txt">PASSWORD</label>
                <input type="password" name="admin_password" class="inpt">
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
        <a href="../user/user_login.php" class="lgn">I AM USER</a>
        </div>      
    </section> 
</body>

</html>
