<?php
require_once '../data/config.php';
include_once ('../dao/UserDao.php');
$userDao=new UserDao();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email=$_POST['email'];
    //判断邮箱是否已注册
    $user=$userDao->selectUserByEmail($email);
    if(count($user)<=0){
        //邮箱未注册
        echo 400;
    }
    else {
        echo 200;
    }
}else{
    //访问非法，自动跳转
    header('Location:'.VIEW_PATH.'index.php');
}