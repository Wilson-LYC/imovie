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
    $userLink=VIEW_PATH.'usercollect.php';
}else{
    $username='登录';
    $userLink=VIEW_PATH.'login.php';
    $avatar=AVATAR_PATH.'头像_avatar.png';
}

$msg=null;
$newAvatar=null;
$fileType=null;
$link=null;
$linkText=null;
$userDao=new UserDao();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDao=new UserDao();
    // 获取表单数据
    $oPass=$_POST['oPass'];
    //原密码加密
    $oPass=md5($oPass);
    $nPass=$_POST['nPass'];
    //旧密码加密
    $nPass=md5($nPass);
    //判断初始密码是否错误
    $user=$userDao->selectUserByUid($_SESSION['user']['uid'])[0];
    if($oPass==$user['password']){
        //初始密码正确
        $res=$userDao->updateUserByUidPass($_SESSION['user']['uid'],$nPass);
        if($res){
            //更新成功
            $msg='密码修改成功';
            $link=VIEW_PATH.'userinfo.php';
            $linkText='返回';
        }
        else{
            //更新失败
            $msg='密码修改失败';
            $link=VIEW_PATH.'updatepwd.php';
            $linkText='重试';
        }
    }
    else{
        //初始密码错误
        $msg='原密码错误';
        $link=VIEW_PATH.'updatepwd.php';
        $linkText='重试';
    }
}
else{
    //访问方式错误，自动跳转至个人详情页
    $msg='访问方式错误';
    $link=VIEW_PATH.'updatepwd.php';
    $linkText='返回';
    header('Location:'.VIEW_PATH.'updatepwd.php');
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMoive | 修改密码</title>
    <link rel="stylesheet" href="../resources/css/updateava.css">
    <link rel="stylesheet" href="../resources/css/foo.css">
    <link rel="stylesheet" href="../resources/css/header.css">
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
        <!--        修改信息-->
        <div class="link-container">
            <a href="<?php echo VIEW_PATH.'userinfo.php'?>">
                <p>个人资料</p>
            </a>
            <a href="<?php echo VIEW_PATH.'updateinfo.php'?>">
                <p>修改资料</p>
            </a>
            <a href="<?php echo VIEW_PATH.'updateEmail.php'?>">
                <p>修改邮箱</p>
            </a>
            <a href="<?php echo VIEW_PATH.'updateava.php'?>">
                <p>修改头像</p>
            </a>
            <a href="<?php echo VIEW_PATH.'updatepwd.php'?>">
                <p id="chose">修改密码</p>
            </a>
            <a href="<?php echo VIEW_PATH.'usercollect.php'?>">
                <p>我的收藏</p>
            </a>
            <a href="<?php echo SERVICE_PATH.'ExitService.php'?>">
                <p>退出登录</p>
            </a>
        </div>
        <div class="item-container">
            <p id="msg">
                <?php echo $msg;?>
            </p>
            <a href="<?php echo $link?>">
                <button id="retry"><?php echo $linkText;?></button>
            </a>
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

