<?php
session_start();
if(isset($_SESSION['login']['userstatus']))
{
    unset($_SESSION['login']['userstatus']);
}
header('location:user_login.php');
?>