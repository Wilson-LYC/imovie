<?php
include_once ('../dao/MySQLConnect.php');
class TypeDao
{
    /**
     * 查询电影类型列表
     * @return array 电影类型列表
     * @Author 赖永超
    */
    function selectMovieTypeList(){
        $mysql=new MySQLConnect();
        $query = "select * from movie_type";
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