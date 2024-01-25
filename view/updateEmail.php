<?php
require '../data/config.php';

/*导航栏用户板块*/
include_once('../dao/UserDao.php');
$username='登录';
$userLink=VIEW_PATH.'login.php';
$avatar=AVATAR_PATH.'头像_avatar.png';
if(isset($_SESSION['login']) && $_SESSION["login"]==true){
    //有登录
    $username=$_SESSION['user']['name'];
    $avatar=AVATAR_PATH.$_SESSION['user']['avatar'];
    $userLink=VIEW_PATH.'userinfo.php';
}else{
    //未登录，跳转到登录页面
    header('Location:'.VIEW_PATH.'login.php');
    $username='登录';
    $userLink=VIEW_PATH.'login.php';
    $avatar=AVATAR_PATH.'头像_avatar.png';
}
$userDao=new UserDao();
$user=$userDao->selectUserByUid($_SESSION['user']['uid'])[0];
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMoive | 修改邮箱</title>
    <link rel="stylesheet" href="../resources/css/updateEmail.css">
    <link rel="stylesheet" href="../resources/css/foo.css">
    <link rel="stylesheet" href="../resources/css/header.css">
    <script src="../resources/js/jquery.min.js" ></script>
    <script src="../resources/js/common.js"></script>
    <link rel="icon" href="../resources/img/material/电影.png" type="image/x-icon">
</head>
<body>
<!--导航栏-->
<div class="header">
    <!--左侧 logo+导航-->
    <div class="header-left">
        <div class="logo">
            <a href="<?php echo VIEW_PATH.'index.php'?>">
                <img src="<?php echo MATERIAL_PATH.'logo.png'?>">
            </a>
        </div>
        <div class="nav">
            <ul>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php'?>">
                        片库
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=动作'?>">
                        动作片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=喜剧'?>">
                        喜剧片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=科幻'?>">
                        科幻片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=灾难'?>">
                        灾难片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=动作'?>">
                        动作片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=惊悚'?>">
                        惊悚片
                    </a>
                </li>
                <li>
                    <a href="<?php echo VIEW_PATH.'list.php?key=剧情'?>">
                        剧情片
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--右侧 头像+名字-->
    <div class="header-right">
        <div class="user">
            <div class="avatar">
                <img src="<?php echo $avatar?>" id="<?php echo $avatar?>">
            </div>
            <div class="user-name">
                <a href="<?php echo $userLink;?>" id="username"><?php echo $username;?></a>
            </div>
        </div>
        <div class="search-container">
            <input type="text" placeholder="搜索" name="search" id="search-input">
            <button id="search-bt" onclick=search()>
                <img src="<?php echo MATERIAL_PATH.'search.png'?>">
            </button>
        </div>
    </div>
</div>
    <!--正文部分-->
    <div class="container">
        <!--正文-->
        <div class="text-container">
            <!--左侧按钮栏-->
            <div class="link-container">
                <a href="<?php echo VIEW_PATH.'userinfo.php'?>">
                    <p>个人资料</p>
                </a>
                <a href="<?php echo VIEW_PATH.'updateinfo.php'?>">
                    <p>修改资料</p>
                </a>
                <a href="<?php echo VIEW_PATH.'updateEmail.php'?>">
                    <p id="chose">修改邮箱</p>
                </a>
                <a href="<?php echo VIEW_PATH.'updateava.php'?>">
                    <p>修改头像</p>
                </a>
                <a href="<?php echo VIEW_PATH.'updatepwd.php'?>">
                    <p>修改密码</p>
                </a>
                <a href="<?php echo VIEW_PATH.'usercollect.php'?>">
                    <p>我的收藏</p>
                </a>
                <a href="<?php echo SERVICE_PATH.'ExitService.php'?>">
                    <p>退出登录</p>
                </a>
            </div>
            <div class="item-container">
                <form name="updateInfo" action="<?php echo SERVICE_PATH.'UpdateEmailService.php'?>" method="post">
                    <div class="form-item">
                        <label>邮箱：</label>
                        <input type="email" name="email" id="email" placeholder="用户名" value="<?php echo $user['email']?>" required>
                    </div>
                    <div class="form-item">
                        <label>验证码：</label>
                        <input type="text" name="code" id="code" placeholder="验证码" value="" onchange=emailChange() required>
                        <input type="button" id="btsendcode" value="获取验证码" onclick=sendCodev2()>
                    </div>
                    <input type="submit" value="修改" id="submit">
                </form>
            </div>
        </div>
    </div>
<!--页脚-->
<div class="web-bottom-container">
    <div class="bottom-logo">
        <a href="<?php echo VIEW_PATH.'/index.php'?>">
            <img src="../resources/img/material/logo_2.png">
        </a>
    </div>
    <div class="copyright">
        <p>
            Copyright © 2023 iMovie. All rights reserved.
        </p>
    </div>
</div>
</body>
</html>