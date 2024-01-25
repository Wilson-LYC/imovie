<?php
include_once ('../dao/MySQLConnect.php');
class OrginDao
{
    /**
     * 查询电影片源地
     * @return array 电影片源地
     * @Author 赖永超
    */
    function selectMovieOrginList(){
        $mysql=new MySQLConnect();
        $query = "select * from movie_orgin";
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