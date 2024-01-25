<?php
require_once '../data/config.php';
include_once('../dao/UserDao.php');
$msg=null;
$pic=null;
$tip=null;
$link="#";
$linkName='网页';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDao=new UserDao();
    // 获取表单数据
    $username = $_POST['username'];
    $email=$_POST['email'];
    $password = $_POST['password'];
    $code=$_POST['code'];
    //判断邮箱是否已注册
    $check=$userDao->selectUserByEmail($email);
    if(count($check)>0){
        //邮箱已注册
        $msg='邮箱已注册';
        $pic=MATERIAL_PATH.'失败.png';
        $link=VIEW_PATH.'register.php';
        $linkName="注册页";
        $tip='3秒后自动跳转到';
        header("refresh:3; url=../view/register.php");
    }
    else {
        //判断验证码是否正确
        if ($code != $_SESSION['code']) {
            $msg = '验证码错误';
            $pic = MATERIAL_PATH . '失败.png';
            $link = VIEW_PATH . 'register.php';
            $linkName = "注册页";
            $tip = '3秒后自动跳转到';
            header("refresh:3; url=../view/register.php");
        } else {
            unset($_SESSION['code']);
            $res = $userDao->register($username, $email, $password);
            if ($res != false) {
                $msg = '注册成功';
                $pic = MATERIAL_PATH . '成功.png';
                $link = VIEW_PATH . 'index.php';
                $linkName = "首页";
                $tip = '3秒后自动跳转到';
                header("refresh:3; url=../view/index.php");
            } else {
                $msg = '注册失败';
                $pic = MATERIAL_PATH . '失败.png';
                $link = VIEW_PATH . 'register.php';
                $linkName = "注册页";
                $tip = '3秒后自动跳转到';
                header("refresh:3; url=../view/register.php");
            }
        }
    }
}
else{
    //访问非法，自动跳转至注册页
    header('Location:'.VIEW_PATH.'register.php');
}
?>
<html>
<header>
    <link rel="stylesheet" href="../resources/css/LRService.css">
    <title>iMoive | 注册</title>
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

