<?php
include_once ('../dao/MySQLConnect.php');
class CommentDao
{
    /**
     * 查询电影评论列表
     * @param $mid 电影id
     * @return array 电影评论列表
     * @Author 赖永超
    */
    function selectMovieComListByMid($mid){
        $mysql=new MySQLConnect();
        $query = "select * from film_criticism where mid=? order by create_time desc";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("i",$mid);
        $res=$stmt->execute();
        $stmt->bind_result($id,$time,$way,$platform,$score,$comment,$uid,$mid,$createTime);
        $res=array();
        while($stmt->fetch()){
            $item=array(
                'id'=>$id,
                'time'=>$time,
                'way'=>$way,
                'platform'=>$platform,
                'score'=>$score,
                'comment'=>$comment,
                'uid'=>$uid,
                'mid'=>$mid,
                'createTime'=>$createTime);
            array_push($res,$item);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }

    /**
     * 添加评论
     * @param $time 观影时间
     * @param $way 观影方式
     * @param $platform 观影平台
     * @param $score 评分
     * @param $comment 评论
     * @param $uid 用户id
     * @param $mid 电影id
     * @return bool 是否添加成功
     * @Author 赖永超
    */
    function addComment($time,$way,$platform,$score,$comment,$uid,$mid){
        //数据库操作
        $mySql=new MySQLConnect();
        $query = "insert into film_criticism(time, way, platform,score,comment,uid,mid) values (?,?,?,?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sssdsii",$time, $way, $platform,$score,$comment,$uid,$mid);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        if($res>0){
            //注册成功
            return true;
        }else{
            return false;
        }
    }
}