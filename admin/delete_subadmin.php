<?php
include('../class.php'); 
$id=$_GET['id'];
$obj=new Subadmin();
$obj->delete($id);
?>
