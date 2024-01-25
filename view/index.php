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
    $username='登录';
    $userLink=VIEW_PATH.'login.php';
    $avatar=AVATAR_PATH.'头像_avatar.png';
}
/*电影板块*/
include_once ('../dao/MovieDao.php');
$movieDao=new MovieDao();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMovie | 首页</title>
    <link rel="stylesheet" href="../resources/css/index.css">
    <link rel="stylesheet" href="../resources/css/foo.css">
    <link rel="stylesheet" href="../resources/css/header.css">
    <script src="../resources/js/jquery.min.js" ></script>
    <script src="../resources/js/index.js"></script>
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
        <div class="banner">
            <div class="banner-pic">
                <ul>
                    <li>
                        <a href="../view/details.php?mid=1">
                            <img src="../resources/img/poster/p2886773577.webp">
                        </a>
                    </li>
                    <li>
                        <a href="../view/details.php?mid=10">
                            <img src="../resources/img/poster/p2579995779.webp">
                        </a>
                    </li>
                    <li>
                        <a href="../view/details.php?mid=10">
                            <img src="../resources/img/poster/p2631735545.webp">
                        </a>
                    </li>
                    <li>
                        <a href="../view/details.php?mid=12">
                            <img src="../resources/img/poster/2109241156106055-0-lp.jpg">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="banner-bar">
                <li class="choose"></li><li></li><li></li><li></li>
            </div>
        </div>
<!--        电影列表-->
        <div class="t-container">
            <div class="t-title">
                动作片
                <a href="<?php echo VIEW_PATH.'list.php?key=动作'?>">
                    更多
                </a>
            </div>
            <div class="movie-container">
                <?php
                $movieList=$movieDao->selectMovieByKey('动作');
                $k=min(count($movieList),4);
                for ($i=0;$i<$k;$i++){
                    $movie=$movieList[$i];
                    ?>
                    <div class="movie">
                        <div class="movie-poster">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                            </a>
                        </div>
                        <div class="movie-name">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <?php echo $movie['name']?>
                            </a>
                        </div>
                        <div class="movie-type">
                            <?php echo $movie['type']?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="t-container">
            <div class="t-title">
                喜剧片
                <a href="<?php echo VIEW_PATH.'list.php?key=喜剧'?>">
                    更多
                </a>
            </div>
            <div class="movie-container">
                <?php
                $movieList=$movieDao->selectMovieByKey('喜剧');
                $k=min(count($movieList),4);
                for ($i=0;$i<$k;$i++){
                    $movie=$movieList[$i];
                    ?>
                    <div class="movie">
                        <div class="movie-poster">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                            </a>
                        </div>
                        <div class="movie-name">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <?php echo $movie['name']?>
                            </a>
                        </div>
                        <div class="movie-type">
                            <?php echo $movie['type']?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="t-container">
            <div class="t-title">
                科幻片
                <a href="<?php echo VIEW_PATH.'list.php?key=科幻'?>">
                    更多
                </a>
            </div>
            <div class="movie-container">
                <?php
                $movieList=$movieDao->selectMovieByKey('科幻');
                $k=min(count($movieList),4);
                for ($i=0;$i<$k;$i++){
                    $movie=$movieList[$i];
                    ?>
                    <div class="movie">
                        <div class="movie-poster">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                            </a>
                        </div>
                        <div class="movie-name">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <?php echo $movie['name']?>
                            </a>
                        </div>
                        <div class="movie-type">
                            <?php echo $movie['type']?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="t-container">
            <div class="t-title">
                动画片
                <a href="<?php echo VIEW_PATH.'list.php?key=动画'?>">
                    更多
                </a>
            </div>
            <div class="movie-container">
                <?php
                $movieList=$movieDao->selectMovieByKey('动画');
                $k=min(count($movieList),4);
                for ($i=0;$i<$k;$i++){
                    $movie=$movieList[$i];
                    ?>
                    <div class="movie">
                        <div class="movie-poster">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                            </a>
                        </div>
                        <div class="movie-name">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <?php echo $movie['name']?>
                            </a>
                        </div>
                        <div class="movie-type">
                            <?php echo $movie['type']?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="t-container">
            <div class="t-title">
                悬疑片
                <a href="<?php echo VIEW_PATH.'list.php?key=悬疑'?>">
                    更多
                </a>
            </div>
            <div class="movie-container">
                <?php
                $movieList=$movieDao->selectMovieByKey('悬疑');
                $k=min(count($movieList),4);
                for ($i=0;$i<$k;$i++){
                    $movie=$movieList[$i];
                    ?>
                    <div class="movie">
                        <div class="movie-poster">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <img src="<?php echo POSTER_PATH.$movie['cover']?>">
                            </a>
                        </div>
                        <div class="movie-name">
                            <a href="<?php echo VIEW_PATH.'details.php?mid='.$movie['mid']?>">
                                <?php echo $movie['name']?>
                            </a>
                        </div>
                        <div class="movie-type">
                            <?php echo $movie['type']?>
                        </div>
                    </div>
                <?php } ?>
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