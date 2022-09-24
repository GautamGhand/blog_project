<?php
session_start();
if(isset($_SESSION['login']['status']))
{
    unset($_SESSION['login']['status']);
}
header('location:admin_login.php');
?>