<?php
include_once ('../dao/MySQLConnect.php');
class LanguageDao
{
    /**
     * 查询电影语言列表
     * @return array 电影语言列表
     * @Author 赖永超
    */
    function selectMovieLanList(){
        $mysql=new MySQLConnect();
        $query = "select * from movie_language";
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