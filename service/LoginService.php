<?php
include_once('../dao/UserDao.php');
require_once '../data/config.php';
$msg=null;
$pic=null;
$tip=null;
$link="#";
$linkName='网页';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDao=new UserDao();
    // 获取表单数据
    $email=$_POST['email'];
    $password = $_POST['password'];
    //密码加密
    $password=md5($password);
    $verify = $_POST["verify"];
    //判断邮箱是否已注册
    $user=$userDao->selectUserByEmail($email);
    if(count($user)<=0){
        //邮箱未注册
        $msg='邮箱未注册';
        $pic=MATERIAL_PATH.'失败.png';
        $link=VIEW_PATH.'login.php';
        $linkName="登录页";
        $tip='3秒后自动跳转到';
        header("refresh:3; url=../view/login.php");
    }
    else {
        //判断验证码是否正确
        if (strtolower($_SESSION["verifyimg"]) != strtolower($verify)) {
            $msg = '验证码错误';
            $pic = MATERIAL_PATH . '失败.png';
            $link = VIEW_PATH . 'login.php';
            $linkName = "登录页";
            $tip = '3秒后自动跳转到';
            header("refresh:3; url=../view/login.php");
        } else {
            if (strcmp($password, $user[0]['password']) == 0) {
                session_start();
                //清除已有session
                unset($_SESSION['user']);
                //设置session
                $_SESSION['user'] = $user[0];
                //去除密码
                unset($_SESSION['user']['password']);
                $_SESSION['login'] = true;
                $msg = '登录成功';
                $pic = MATERIAL_PATH . '成功.png';
                $link = VIEW_PATH . 'list.php';
                $linkName = "首页";
                $tip = '3秒后自动跳转到';
                header("refresh:3; url=../view/index.php");
            } else {
                $msg = '密码错误';
                $pic = MATERIAL_PATH . '失败.png';
                $link = VIEW_PATH . 'login.php';
                $linkName = "登录页";
                $tip = '3秒后自动跳转到';
                header("refresh:3; url=../view/login.php");
            }
        }
    }
}
else{
    //访问非法，自动跳转
    header('Location:'.VIEW_PATH.'login.php');
}
?>

<html>
<header>
    <link rel="stylesheet" href="../resources/css/LRService.css">
    <title>iMoive | 登录</title>
    <link rel="icon" href="../resources/img/material/电影.png" type="image/x-icon">
</header>
<body>
<!--输入框-->
<div class="main">
    <div class="container">
        <div class="logo">
            <a href="<?php echo VIEW_PATH.'index.php'?>">
                <img src="<?php echo MATERIAL_PATH.'logo_2.png'?>">
            </a>
        </div>
        <div class="form-container">
            <div class="f-title">
                <?php
                echo $msg;
                ?>
            </div>
            <div class="resimg">
                <img src="<?php echo $pic?>">
            </div>
            <div class="prompt">
                <?php echo $tip?><a href="<?php echo $link?>"><?php echo $linkName?></a>
            </div>
        </div>
    </div>
    <!--页脚-->
    <div class="web-bottom-container">
        <div class="copyright">
            <p>
                Copyright © 2023 iMovie. All rights reserved.
            </p>
        </div>
    </div>
</div>
</body>
</html>

