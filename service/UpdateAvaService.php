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

$userDao=new UserDao();
$user=$userDao->selectUserByUid($_SESSION['user']['uid'])[0];

$msg=null;
$newAvatar=null;
$fileType=null;
$link=null;
$linkText=null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 判断是否有文件上传
    if (empty($_FILES['file']['name'])) {
        $msg = "请选择要上传的头像";
        $link = VIEW_PATH . 'updateava.php';
        $linkText = "重新上传";
    } else {
        //获取信息
        $newAvatar = time() . '_' . $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        //判断是否为允许的文件类型
        $allowed_type = array("image/jpeg", "image/png");
        if (!in_array($fileType, $allowed_type)) {
            $msg = "头像格式不正确";
            $link = VIEW_PATH . 'updateava.php';
            $linkText = "重新上传";
        } else {
            //头像目录
            $upload_dir = "../resources/img/avatar/";
            //头像路径
            $upload_file = $upload_dir . $newAvatar;
            //上传
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                //更新数据库
                $res = $userDao->updateUserByUidAvatar($_SESSION['user']['uid'], $newAvatar);
                if ($res) {
                    $_SESSION['user']['avatar'] = $newAvatar;
                    $msg = "头像上传成功";
                    $link = VIEW_PATH . 'userinfo.php';
                    $linkText = "返回";
                } else {
                    $msg = "头像上传失败";
                    $link = VIEW_PATH . 'updateava.php';
                    $linkText = "重新上传";
                }
            } else {
                $msg = "头像上传失败";
                $link = VIEW_PATH . 'updateava.php';
                $linkText = "重新上传";
            }
        }
    }
}else{
    //访问方式错误，自动跳转至个人详情页
    $msg='访问方式错误';
    $link=VIEW_PATH.'updateava.php';
    $linkText='返回';
    header('Location:'.VIEW_PATH.'updateava.php');
}

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMoive | 修改头像</title>
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
                    <p id="chose">修改头像</p>
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