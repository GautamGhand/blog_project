<?php
include('../class.php');
$id=$_GET['id'];
$obj=new Blog();
$obj->delete($id);
?>