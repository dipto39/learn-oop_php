<?php

include "database.php";
$obj=new database();
$id=$_POST['sid'];
$name=$_POST['name'];
$rool=$_POST['rool'];
$fname=$_POST['fname'];
$arr=['Name'=>$name,'rool'=>$rool,'fname'=>$fname];
if($obj->update("student",$arr,$id)){
    // print_r($obj->show_result());
    echo '<script>alert("data update success")</script>';
}else{
    echo '<script>alert("data update unsuccess")</script>';
}

?>