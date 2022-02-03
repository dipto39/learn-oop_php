<?php

use function PHPSTORM_META\type;

include "database.php";
$obj=new database();
// // $obj->update("student",['Name'=>'ditfpto','Rool'=>'3','fname'=>'dilddip'],14);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Testing_OOP</title>
    <style>
        *{margin:0;padding: 0;box-sizing: border-box;}
        .mani{

        }
        table{
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th{
            border: 1px solid black;
            background-color: dodgerblue;
            color: white;
        }
        tr{
            border: 1px solid black;

        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        td{
            border: 1px solid black;
        }
        .page {
           display: grid;
           place-items: center;
           margin-top: 20px;
        }
        .page ul{
            display: flex;
            align-items: center;
            list-style: none;
        }
        .page ul li{
            background-color: dodgerblue;
            color: white;
            margin: 0 10px;
        }
        a{
            text-decoration: none;
            color: white;
            padding: 10px;

        }
        .model{
            position:fixed;
            top: 0;
            width: 100%;
            height: 100%;
            background-color:rgba(0,0,0,0.4);
            display: none;
        }
        .modelc{
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: white;
            padding: 20px;
        }
        .modelc input{
            width: 100%;
            padding: 5px;
        }
        input[type='button']:hover{
            background-color: red;
        }
        input[type='submit']:hover{
            background-color: lightseagreen;
        }
        .del button{
            padding: 6px 12px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="inpu">
        <form id="iform">
        <label for="iname">Nmae: <input type="text" id="iname" name="iname"></label>
        <label for="irool">Rool: <input type="text" id="irool" name="irool"></label>
        <label for="ifname">Nmae: <input type="text" id="ifname" name="ifname"></label>
        <input type="submit" >
        </form>
        </div>
        <table>
             <tr>
                <th>SI</th>
                <th>Sid</th>
                <th>Name</th>
                <th>Rool</th>
                <th>Father Name</th>
                <th>Delete</th>
                <th>Edit</th>
             </tr>
             <?php
   $obj->select("student",);
   $result=$obj->show_result();
   $inc=1;
foreach($result[0] as list("sid"=>$sid,"Name" =>$sname,"Rool" => $rool,"fname"=>$fname)){
    echo '<tr>';
    echo "<td>$inc</td><td>$sid</td><td>$sname</td><td>$rool</td><td>$fname</td><td><button id='$sid' class='delete'>Delete</button></td><td><button id='$sid' class='edit'>edit</button></td>";
    echo '</tr>';
    $inc=$inc +1;
}

// echo type($obj->show_result());
             ?>
             
        </table>
        <div class="page">
            <ul>
                <li><a href="">Prev</a></li>
                <li><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">Next</a></li>
            </ul>
        </div>
    
    </div>
    <div id="imp"></div>
    <div class="model">
            <div class="modelc">
               <div class="del">
                    <h2>Are you sure to delete this data?</h2>
                    <button id="ok">ok</button>
                    <button class='btnc'>cancel</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var edit=document.querySelectorAll('.edit');
            var del=document.querySelector('.delete');
            var modelc=document.querySelector('.modelc');
            
            $(document).on('click','#cbtn',function(e){
                $('.model').css('display','none');
                $("#mod").remove();
            })
            
            $(document).on('click','.btnc',function(e){
                $('.model').css('display','none')
            })
            $('.edit').on('click',function(e){
                var id=e.target.id;
                $.ajax({
                    url:"getdata.php",
                    type:"post",
                    data:{id:id},
                    success:function(e){
                       $('body').append(e);
                       $('.model').css("display","block");
                    }
                })
            })
            $(document).on('submit','#form',function(e){
                e.preventDefault();
               var fd=$('#form').serialize();
                $.ajax({
                    url:"update.php",
                    type:"post",
                    data:fd,
                    success:function(e){
                       $('body').append(e);
                       $('.model').css("display","none");
                       $('#mod').remove();
                       location.reload();
                    }
                })
            })
            $('.delete').on('click',function(e){
                var id=e.target.id;
                // console.log(id);
                $(".model").css("display","block");
                $("#ok").on("click",function(){
                    $.ajax({
                    url:"delete.php",
                    type:"post",
                    data:{id:id},
                    success:function(e){
                        // $('body').append(e);
                      location.reload();
                    }
                })
                })
               
            })
            $(document).on('submit',"#iform",function(e){
                e.preventDefault();
                var fd=$("#iform").serialize();
                $.ajax({
                    url:"insert.php",
                    type:"post",
                    data:fd,
                    success:function(e){
                        $('body').append(e);
                        location.reload();
                    }
                })
            })
        
        </script>
        
</body>
</html>