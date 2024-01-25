<?php
require '../data/config.php';
/*导航栏用户板块*/
include_once('../dao/UserDao.php');
$username='登录';
$userLink=VIEW_PATH.'login.php';
$avatar=AVATAR_PATH.'头像_avatar.png';
$uid=null;
if(isset($_SESSION['login']) && $_SESSION["login"]==true){
    //有登录
    $username=$_SESSION['user']['name'];
    $avatar=AVATAR_PATH.$_SESSION['user']['avatar'];
    $userLink=VIEW_PATH.'userinfo.php';
    // 获取表单数据
    $uid=$_SESSION['user']['uid'];
}else{
    //未登录，跳转到登录页面
    header('Location:'.VIEW_PATH.'login.php');
    $username='登录';
    $userLink=VIEW_PATH.'login.php';
    $avatar=AVATAR_PATH.'头像_avatar.png';
    header("refresh:0; url=../view/login.php");
    echo "<script>" . chr(10);
    echo "alert(\"请登录\");" . chr(10);
    echo "</script>" . chr(10);
}
/*收藏列表*/
include_once ('../dao/CollectDao.php');
$collectDao=new CollectDao();
$collectList=$collectDao->selectUserColListByUid($uid);
/*电影信息*/
include_once ('../dao/MovieDao.php');
$movieDao=new MovieDao();
$movieList=array();
foreach ($collectList as $item){
    $aMovie=$movieDao->selectMovieByMid($item['mid'])[0];
    array_push($movieList,$aMovie);
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMoive | 我的收藏</title>
    <link rel="stylesheet" href="../resources/css/usercollect.css">
    <link rel="stylesheet" href="../resources/css/foo.css">
    <link rel="stylesheet" href="../resources/css/header.css">
    <script src="../resources/js/jquery.min.js" ></script>
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
                    <p >个人资料</p>
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
                    <p>修改密码</p>
                </a>
                <a href="<?php echo VIEW_PATH.'usercollect.php'?>" >
                    <p id="chose">我的收藏</p>
                </a>
                <a href="<?php echo SERVICE_PATH.'ExitService.php'?>">
                    <p>退出登录</p>
                </a>
            </div>
            <div class="item-container">
                <div class="movie-container">
                    <?php
                    if (count($movieList)<=0){
                        echo '<div class="no-collect">暂无收藏</div>';
                    }
                    else{
                    foreach ($movieList as $movie){
                        ?>
                        <div class="movie">
                            <div class="movie-poster">
                                <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                    <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                                </a>
                                <!--                        <a href="--><?php //echo VIEW_PATH.'/details.php?mid='.$movie['mid']?><!--">-->
                                <!--                            <img src="--><?php //echo POSTER_PATH.'/p2889358680.webp'?><!--">-->
                                <!--                        </a>-->
                            </div>
                            <div class="movie-name">
                                <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                    <?php echo $movie['name']?>
                                </a>
                                <!--                        <a href="#>">-->
                                <!--                           银河护卫队3-->
                                <!--                       </a>-->
                            </div>
                            <div class="movie-type">
                                <?php echo $movie['type']?>
                            </div>
                        </div>
                    <?php }} ?>
                </div>
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