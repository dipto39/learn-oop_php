<?php
$id=$_POST['id'];
include "database.php";
$obj=new database();

$obj->select("student","*",null,$id,null,null);
$res=$obj->show_result();
$pass='';
foreach($res[0] as list('sid' =>$sid,'Name' =>$name,'Rool' =>$rool,'fname' =>$fname)){
    $pass.=' <div class="model" id="mod">
    <div class="modelc"><form id="form">
    <input type="text" name="sid" value='."$sid".' id="id" hidden>
    <label for="name">
    Name:
    <input type="text" name="name" value='.urlencode($name).' id="name">
    </label>
    <label for="rool">
    Rool:
    <input type="text" name="rool" value='."$rool".' id="rool">
    </label>
    <label for="rool">
    fname:
    <input type="text" name="fname" value='."$fname".' id="fname">
    </label>
    <input type="submit" value="update" class="up" id='."$sid".'>
    <input type="button" value="cancel" id="cbtn">
    </form> </div> </div>';
}

echo $pass;
?>