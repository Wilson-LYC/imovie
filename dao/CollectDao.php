<?php
include_once ('MySQLConnect.php');
class CollectDao
{
    /**
     * 收藏/取消收藏电影
     * @param $mode 0取消收藏 1收藏
     * @return bool 是否成功
     * @Author 赖永超
    */
    function changeCollect($uid,$mid,$mode){
        $mysql=new MySQLConnect();
        $query=null;
        if($mode==1){
            //收藏
            $query = "insert into collection(uid,mid) values (?,?)";
        }
        else{
            //取消收藏
            $query = "delete from collection where uid=? and mid=?";
        }
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ii",$uid,$mid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
    /**
     * 查询用户是否收藏电影
     * @return bool 是否收藏
     * @Author 赖永超
     * @param $uid 用户id
     * @param $mid 电影id
     * @return bool 是否收藏
    */
    function selectCollect($uid,$mid){
        $mysql=new MySQLConnect();
        $query = "select id from collection where uid=? and mid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ii",$uid,$mid);
        $res=$stmt->execute();
        $stmt->bind_result($i);
        $num=0;
        while ($stmt->fetch()){
            $num++;
        }
        $stmt->close();
        $mysql->link->close();
        return $num>0;
    }

    /**
     * 查询用户收藏列表
     * @param $uid 用户id
     * @return array 用户收藏列表
     * @Author 赖永超
    */
    function selectUserColListByUid($uid)
    {
        $mysql=new MySQLConnect();
        $query = "select * from collection where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("i",$uid);
        $res=$stmt->execute();
        $stmt->bind_result($id,$uid,$mid,$createTime);
        $res=array();
        while($stmt->fetch()){
            $item=array(
                'id'=>$id,
                'uid'=>$uid,
                'mid'=>$mid,
                'createTime'=>$createTime);
            array_push($res,$item);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
}