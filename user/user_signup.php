<?php
include('controller..php');
if (isset($_POST['signup']))
{
    $obj = new User($_POST);
    $obj->signup();
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
            <form action="user_signup.php" method="POST">
                <label class="txt">FIRST NAME</label>
                <input type="text" name="firstname" class="inpt">
                <div class="error">
                <?php
                    if(!empty($_SESSION['error']['firstname']))
                    {
                        echo $_SESSION['error']['firstname'];
                    }
                ?>
                </div>
                <label class="txt">LAST NAME</label>
                <input type="text" name="lastname"  class="inpt">
                <div class="error">
                <?php
                    if(!empty($_SESSION['error']['lastname']))
                    {
                        echo $_SESSION['error']['lastname'];
                    }
                ?>
                </div>
                <label class="txt">EMAIL</label>
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
                <input type="submit" name="signup" value="SIGNUP" class="btn">
            </form>
        </section>
    </section>
</body>

</html>
<?php
echo "<a href=\"user_login.php\" class=\"active\">BACK</a>"; 
?>