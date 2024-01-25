<?php
include_once ('../dao/MySQLConnect.php');
class MovieDao
{
    /**
     * 查询电影列表
     * @param $mid 电影id
     * @return array 电影列表
     * @Author 赖永超
    */
    function selectMovieByMid($mid){
        $mysql=new MySQLConnect();
        $query = "select * from movie_info where mid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("i",$mid);
        $res=$stmt->execute();
        $stmt->bind_result($mid,$name,$alias,$type,$version,$language,$duration,$origin,$director,$actor,$release_time,$score_db,$score_my,$score_tpp,$income,$buy_link,$buy_type,$preview,$introduction,$cover,$characteristic);
        $res=array();
        while($stmt->fetch()){
              $movie=array(
                  'mid'=>$mid,//电影id
                  'name'=>$name,//电影名
                  'alias'=>$alias,//电影别名（英文名）
                  'type'=>$type,//电影类型
                  'version'=>$version,//电影版本
                  'language'=>$language,//电影语言
                  'duration'=>$duration,//电影时长
                  'origin'=>$origin,//电影产地
                  'director'=>$director,//电影导演
                  'actor'=>$actor,//电影演员
                  'release_time'=>$release_time,//电影上映时间
                  'score_db'=>$score_db,//豆瓣评分
                  'score_my'=>$score_my,//猫眼评分
                  'score_tpp'=>$score_tpp,//淘票票评分
                  'income'=>$income,//电影票房
                  'buy_link'=>$buy_link,//在线观看/购票连接
                  'buy_type'=>$buy_type,//在线观看/立即购票
                  'preview'=>$preview,//电影预告片
                  'introduction'=>$introduction,//电影简介
                  'cover'=>$cover,//电影封面
                  'characteristic'=>$characteristic);//电影特色
              array_push($res,$movie);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }

    /**
     * 查询电影列表（根据关键词）
     * @param $key 关键字
     * @return array 电影列表
     * @Author 赖永超
    */
    function selectMovieByKey($key){
        $res=array();
        $key="%".$key."%";
        $mysql=new MySQLConnect();
        $query = "select * from movie_info where `type` like ? or `language` like ? or `origin` like ? or `version` like ? or `name` like ? or `introduction` like ? or `director` like ? or `actor` like ? or `alias` like ? or `buy_type` like ?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ssssssssss",$key,$key,$key,$key,$key,$key,$key,$key,$key,$key);
        $stmt->execute();
        $stmt->bind_result($mid,$name,$alias,$type,$version,$language,$duration,$origin,$director,$actor,$release_time,$score_db,$score_my,$score_tpp,$income,$buy_link,$buy_type,$preview,$introduction,$cover,$characteristic);
        while($stmt->fetch()){
            $movie=array(
                'mid'=>$mid,
                'name'=>$name,
                'alias'=>$alias,
                'type'=>$type,
                'version'=>$version,
                'language'=>$language,
                'duration'=>$duration,
                'origin'=>$origin,
                'director'=>$director,
                'actor'=>$actor,
                'release_time'=>$release_time,
                'score_db'=>$score_db,
                'score_my'=>$score_my,
                'score_tpp'=>$score_tpp,
                'income'=>$income,
                'buy_link'=>$buy_link,
                'buy_type'=>$buy_type,
                'preview'=>$preview,
                'introduction'=>$introduction,
                'cover'=>$cover,
                'characteristic'=>$characteristic);
                array_push($res,$movie);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
}