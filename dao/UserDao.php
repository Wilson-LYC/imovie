<?php
include_once ('MySQLConnect.php');
class UserDao
{
    /**
     * 用户注册
     * @param $name 用户名
     * @param $email 邮箱
     * @param $password 密码
     * @return bool 是否注册成功
     * @Author 赖永超
    */
    function register($name,$email,$password){
        //设置默认头像
        $avatar='default_avatar.png';
        //设置默认简介
        $introduction='这个人很懒，什么都没有留下';
        //默认性别
        $gender="未知";
        //密码加密
        $password=md5($password);
        //数据库操作
        $mySql=new MySQLConnect();
        $query = "insert into user_info(name,email,password,avatar,introduction,gender) values (?,?,?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ssssss",$name, $email, $password,$avatar,$introduction,$gender);
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
    function selectUserByEmail($email){
        $mysql=new MySQLConnect();
        $query = "select name,email,password,avatar,uid,create_time,introduction,gender from user_info where email=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($name,$email,$password,$avatar,$uid,$createTime,$introduction,$gender);
        $res=array();
        while($stmt->fetch()){
              $user=array('name'=>$name,
                  'email'=>$email,
                  'password'=>$password,
                  'avatar'=>$avatar,
                  'uid'=>$uid,
                  'createTime'=>$createTime,
                  'introduction'=>$introduction,
                  'gender'=>$gender);
              array_push($res,$user);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
    /**
     * 通过uid获取用户信息
     * @param $uid 用户id
     * @return array 用户信息
     * @Author 赖永超
    */
    function selectUserByUid($uid){
        $mysql=new MySQLConnect();
        $query = "select name,email,password,avatar,uid,create_time,introduction,gender from user_info where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("s",$uid);
        $stmt->execute();
        $stmt->bind_result($name,$email,$password,$avatar,$uid,$createTime,$introduction,$gender);
        $res=array();
        while($stmt->fetch()){
            $user=array('name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'avatar'=>$avatar,
                'uid'=>$uid,
                'createTime'=>$createTime,
                'introduction'=>$introduction,
                'gender'=>$gender);
            array_push($res,$user);
        }
        $stmt->close();
        $mysql->link->close();
        return $res;
    }
    function updateUserByUidInfo($uid,$name,$introduction,$gender){
        $mysql=new MySQLConnect();
        $query = "update user_info set name=?,introduction=?,gender=? where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ssss",$name,$introduction,$gender,$uid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        if($res>0){
            //更新成功
            return true;
        }else{
            return false;
        }
    }
    /**
     * 通过uid更新用户密码
     * @param $uid 用户id
     * @param $nPass 新密码
     * @return bool 是否更新成功
     * @Author 赖永超
    */
    public function updateUserByUidPass($uid, $nPass)
    {
        $mysql=new MySQLConnect();
        $query = "update user_info set password=? where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ss",$nPass,$uid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        if($res>0){
            //更新成功
            return true;
        }else{
            return false;
        }
    }
    /**
     * 通过uid更新用户头像
     * @param $uid 用户id
     * @param $avatar 头像
     * @return bool 是否更新成功
     * @Author 赖永超
    */
    public function updateUserByUidAvatar($uid,$avatar){
        $mysql=new MySQLConnect();
        $query = "update user_info set avatar=? where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ss",$avatar,$uid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        if($res>0){
            //更新成功
            return true;
        }else{
            return false;
        }
    }
    /**
     * 通过uid修改用户邮箱
     * @param $uid [用户id]
     * @param $email [邮箱]
     * @return bool 是否更新成功
     * @Author 赖永超
    */
    public function updateUserByUidEmail($uid,$email){
        $mysql=new MySQLConnect();
        $query = "update user_info set email=? where uid=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ss",$email,$uid);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        if($res>0){
            //更新成功
            return true;
        }else{
            return false;
        }
    }
    /**
     * 通过邮箱修改密码
     * @param $email 邮箱
     * @param $password 密码
     * @return bool 是否更新成功
     * @Author 赖永超
    */
    public function updatePasswordByEmail($email,$password){
        //密码加密
        $password=md5($password);
        $mysql=new MySQLConnect();
        $query = "update user_info set password=? where email=?";
        $stmt = $mysql->link->prepare($query);
        $stmt->bind_param("ss",$password,$email);
        $res=$stmt->execute();
        $stmt->close();
        $mysql->link->close();
        if($res>0){
            //更新成功
            return true;
        }else{
            return false;
        }
    }
}