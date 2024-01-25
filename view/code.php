<?php
include_once('../dao/UserDao.php');
require_once '../data/config.php';
$msg=null;
$pic=null;
$tip=null;
$link="#";
$linkName='网页';
$email=null;
$username=null;
$password=null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDao=new UserDao();
    // 获取表单数据
    $username = $_POST['username'];
    $email=$_POST['email'];
    $password = $_POST['password'];
    //判断手机号是否已注册
    $check=$userDao->selectUserByEmail($email);
    if(count($check)>0){
        $link=VIEW_PATH.'register.php';
        //邮箱已注册
        header('refresh:0; url="../view/register.php"');
        echo '<script>alert("邮箱已注册");</script>';
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMovie | 邮箱验证</title>
    <link rel="stylesheet" href="../resources/css/LRView.css">
    <script src="../resources/js/jquery.min.js" ></script>
    <script src="../resources/js/common.js"></script>
    <link rel="icon" href="../resources/img/material/电影.png" type="image/x-icon">
</head>
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
                邮 箱 激 活
            </div>
            <div class="user-form-c">
                <form name="register" action="<?php echo SERVICE_PATH.'RegisterService.php' ?>"  method="post" class="user-form">
                    <input type="text" placeholder="验证码" id="code" name="code" required>
                    <input type="hidden" name="email" id="email" value="<?php echo $email?>">
                    <input type="hidden" name="username" id="username" value="<?php echo $username?>">
                    <input type="hidden" name="password" id="password" value="<?php echo $password?>">
                    <input type="button" value="获取验证码" id="btsendcode" onclick=sendCode("<?php echo $email;?>")>
                    <input type="submit" value="提 交" id="submit1">
                </form>
            </div>
            <div class="link">
                没有收到验证码？ <a href="#" onclick=sendCode("<?php echo $email;?>")>重发</a>
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
