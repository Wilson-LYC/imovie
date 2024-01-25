<?php
include_once ('../dao/MySQLConnect.php');
class MoviePicDao
{
    /**
     * 查询电影图片列表
     * @return array 电影图片列表
     * @Author 赖永超
     * @param $mid 电影id
    */
    function selectMoviePicByMid($mid){
        $mysql=new MySQLConnect();
        $query = "select * from movie_pic where mid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("i",$mid);
        $res=$stmt->execute();
        $stmt->bind_result($pid,$mid,$path,$like);
        $res=array();
        while($stmt->fetch()){
              $item=array(
                  'pid'=>$pid,
                  'mid'=>$mid,
                  'path'=>$path,
                  'like'=>$like);
              array_push($res,$item);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
    /**
     * 点赞图片
     * @Author 赖永超
     * @param $pid 图片id
     * @param $likeNum 点赞数
     * @return bool 是否点赞成功
    */
    function picLikeByPid($pid,$likeNum){
        $mysql=new MySQLConnect();
        $query = "UPDATE `movie_pic` SET `like` = ? WHERE `movie_pic`.`pid` = ?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ii",$likeNum,$pid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
}