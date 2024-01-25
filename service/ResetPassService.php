<?php
require_once '../data/config.php';
include_once ('../dao/UserDao.php');
$userDao=new UserDao();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //获取邮箱、验证码和密码
    $email=$_POST['email'];
    $code=$_POST['code'];
    $password=$_POST['password'];
    //判断验证码是否正确
    if (strtolower($_SESSION["code"]) != strtolower($code)) {
        echo 401;
    } else {
        //修改密码
        if($userDao->updatePasswordByEmail($email,$password)){
            echo 200;
        }
        else
            echo 400;
    }
}else{
    //访问方式错误，自动跳转重置密码页
    header('Location:'.VIEW_PATH.'ResetPassword.php');
}