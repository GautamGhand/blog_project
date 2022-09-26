<?php
include('controller.php'); 
$id=$_GET['id'];
$obj=new Admin();
$obj->delete('admin',$id);
?>
