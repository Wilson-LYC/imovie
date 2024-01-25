<?php
require_once '../data/config.php';
$movie=null;
$key="";
$webTitil='iMoive';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //获取表单数据
    if(isset($_GET['key'])){
        $key=$_GET['key'];
        $webTitil=$webTitil.' | '.$key;
    }
}

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
/*电影信息*/
include_once ('../dao/MovieDao.php');
$movieDao=new MovieDao();
$movieList=$movieDao->selectMovieByKey($key);
if(count($movieList)<=0){
    header('refresh:0; url=list.php');
    echo "<script>" . chr(10);
    echo "alert(\"很抱歉，未找到相关电影\");" . chr(10);
    echo "</script>" . chr(10);
}
/*电影类别*/
include_once ('../dao/TypeDao.php');
$typeDao=new TypeDao();
$typeList=$typeDao->selectMovieTypeList();
include_once ('../dao/LanguageDao.php');
$languageDao=new LanguageDao();
$lanList=$languageDao->selectMovieLanList();
include_once ('../dao/OrginDao.php');
$orginDao=new OrginDao();
$orginList=$orginDao->selectMovieOrginList();
include_once ('../dao/CharacteristicDao.php');
$chaDao=new CharacteristicDao();
$chaList=$chaDao->selectMovieCharacteristicList();
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $webTitil?></title>
    <link rel="stylesheet" href="../resources/css/list.css">
    <link rel="stylesheet" href="../resources/css/foo.css">
    <link rel="stylesheet" href="../resources/css/header.css">
    <script src="../resources/js/jquery.min.js" ></script>
    <script src="../resources/js/details.js"></script>
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
            <div class="link-container">
                <div class="link-itme">
                    <p>类型</p>
                    <a href="../view/list.php">
                        <p>全部</p>
                    </a>
                    <?php
                        foreach ($typeList as $itme){
                    ?>
                    <a href="<?php echo VIEW_PATH.'list.php?key='.$itme['name']?>">
                        <p><?php echo $itme['name'];?></p>
                    </a>
                    <?php } ?>
                </div>
                <div class="link-itme">
                    <p>语言</p>
                    <?php
                    foreach ($lanList as $itme){
                        ?>
                        <a href="<?php echo VIEW_PATH.'list.php?key='.$itme['name']?>">
                            <p><?php echo $itme['name'];?></p>
                        </a>
                    <?php } ?>
                </div>
                <div class="link-itme">
                    <p>地区</p>
                    <?php
                    foreach ($orginList as $itme){
                        ?>
                        <a href="<?php echo VIEW_PATH.'list.php?key='.$itme['name']?>">
                            <p><?php echo $itme['name'];?></p>
                        </a>
                    <?php } ?>
                </div>
                <div class="link-itme">
                    <p>特色</p>
                    <?php
                    foreach ($chaList as $itme){
                        ?>
                        <a href="<?php echo VIEW_PATH.'list.php?key='.$itme['name']?>">
                            <p><?php echo $itme['name'];?></p>
                        </a>
                    <?php } ?>
                </div>
                <div class="link-itme">
                    <p>观看</p>
                        <a href="<?php echo VIEW_PATH.'list.php?key=在线观看'?>">
                            <p>在线观看</p>
                        </a>
                        <a href="<?php echo VIEW_PATH.'list.php?key=立即购票'?>">
                            <p>立即购票</p>
                        </a>
                </div>
            </div>
            <div class="keyy">
                <?php
                if (isset($_GET['key']))
                    echo '👇'.$key.'👇';
                ?>
            </div>
            <div class="movie-container">
                <?php
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
                <?php } ?>
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