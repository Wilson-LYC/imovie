<?php
include_once ('MySQLConnect.php');
class CharacteristicDao
{
    /**
     * 查询电影特色列表
     * @author 赖永超
     * @return array 电影特色列表
    */
    function selectMovieCharacteristicList(){
        $mysql=new MySQLConnect();
        $query = "select * from movie_characteristic";
        $stmt = $mysql->link->prepare($query);
        $res=$stmt->execute();
        $stmt->bind_result($id,$name);
        $res=array();
        while($stmt->fetch()){
            $item=array(
                'id'=>$id,
                'name'=>$name);
            array_push($res,$item);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
}