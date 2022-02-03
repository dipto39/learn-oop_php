<?php
class database{
    private $host= "localhost";
    private $h_user= "root";
    private $h_pass= "";
    private $dbname= "test";

    private $mysqli="";
    private $result= array();
    private $conn=false;

    public function __construct(){
    if(!$this->conn){
        $this->mysqli=new mysqli($this->host,$this->h_user,$this->h_pass,$this->dbname);
        if($this->mysqli->connect_error){
            array_push($this->result,$this->mysqli->connect_error);
            return false;
        }
    }else{
        return true;
    }
        
    }
    //select function
    public function select($table,$colume="*",$join=null,$where=null,$order=null,$limit=null){
        if($this->tableExists($table)){
            $sql="select $colume from $table ";
            if(!$join == null){
                $sql.="inner join $join ";
            }
            if(!$where == null){
                $sql.="where sid = $where ";
            }
            if(!$order == null){
                $sql.="order by $order ";
            }
            if(!$limit == null){
                $sql.="limit 0,$limit ";
                
            }
            $res=$this->mysqli->query($sql);
            if($res){
                array_push($this->result,$res->fetch_all(MYSQLI_ASSOC));
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
        }
    }
    //insert function
     public function insert($table,$pram=array()){
        if($this->tableExists($table)){
            // print_r(array_keys($pram));
            $arval=implode("','",$pram);
             $arkey=implode(",",array_keys($pram));
             $sql="insert into $table($arkey) values('$arval')";
             $res=$this->mysqli->query($sql);
             if($res){
                array_push($this->result,$this->mysqli->insert_id);
                return true;
             }else{
                 array_push($this->result,$this->mysqli->error);
                 return false;
             }

        }else{
            array_push($this->result,"table are not exist '$table'");
            return false;
        }
          
    }
    //update function
     public function update($table,$pram=array(),$where=null){
        if($this->tableExists($table)){
            // print_r($pram);
            $arr=array();
            foreach($pram as $key => $val){
                $arr[]="$key = '$val' ";
            }
            // echo $arr;
            $sql="update $table set ". implode(', ',$arr) ."where sid = $where";
            $res=$this->mysqli->query($sql);
            if($sql){
                array_push($this->result,$sql);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
        }
    }
    //delete function
    public function delete_row($table,$where){
        if($this->tableExists($table)){
        $sql="delete from $table where sid =$where";
        $res=$this->mysqli->query($sql);
        if($res){
            return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }
    }
    }
    //tabaile exist
    private function tableExists($table){
        $sql="show tables from $this->dbname like '$table'";
        $sqlbd=$this->mysqli->query($sql);
        if($sqlbd){
            if($sqlbd->num_rows > 0){
                return true;
            }else{
            array_push($this->result,$this->mysqli->error);
                return false;
            }
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }
    }
    ///show resutl
    public function show_result(){
        $val=$this->result;
        $this->result = array();
        return $val;
    }

    //select function
    function __destruct()
    {
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn=false;
                return true;
            }
        }else{
            return false;
        }
        
    }
}
?>