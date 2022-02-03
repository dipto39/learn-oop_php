<?php 
include "database.php";
$obj=new database();
$id=$_POST['id'];
echo $id;
if($obj->delete_row("student",$id)){
    echo "<script>alert('data delete success')</script>";
}else{
    echo "<script>alert('data delete unsuccess')</script>";
}
?>