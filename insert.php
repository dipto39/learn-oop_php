<?php
include "database.php";
$obj=new database();
 $name=$_POST['iname'];
 $rool=$_POST['irool'];
 $fname=$_POST['ifname'];
 $ar=['Name'=>$name,'Rool'=>$rool,'fname'=>$fname];
 if($obj->insert("student",$ar)){
     echo '';
     // echo "<meta http-equiv='refresh' content='0'>";
       echo "<script>alert('insert succesfully')</script>";
     // echo "<script>location.reload()</script>";
 }else{
     echo "<script>alert('insert unsuccesfully')</script>";
 }
?>