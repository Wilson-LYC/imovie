<?php
require_once '../data/config.php';
$movie=null;
$mid=1;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //获取表单数据
    $mid=$_GET['mid'];
}
else{
    //访问途径异常
    header('refresh:0; url=index.php');
}
/*收藏状态*/
include_once ('../dao/CollectDao.php');
$collectDao=new CollectDao();
$colSta=false;
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
    $colSta=$collectDao->selectCollect($_SESSION['user']['uid'],$mid);
}else{
    $username='登录';
    $userLink=VIEW_PATH.'login.php';
    $avatar=AVATAR_PATH.'头像_avatar.png';
}
/*信息加载模块*/
include_once('../dao/MovieDao.php');
//获取数据库数据
$movieDao=new MovieDao();
$data=$movieDao->selectMovieByMid($mid);
if(count($data)<=0){
    //mid错误，跳转至其他页面
    echo "<script>" . chr(10);
    echo "alert(\"mid错误\");" . chr(10);
    echo "</script>" . chr(10);
    header('refresh:0; url=index.php');
}else{
    $movie=$data[0];
}
/*电影海报列表模块*/
include_once('../dao/MoviePicDao.php');
$moviePicDao=new MoviePicDao();
$picNum=0;
$picList=$moviePicDao->selectMoviePicByMid($mid);
$picNum=count($picList);
/*评论板块*/
include_once ('../dao/UserDao.php');
include_once('../dao/CommentDao.php');
$userDao=new UserDao();
$commentDao=new CommentDao();
$comNum=0;
$comList=$commentDao->selectMovieComListByMid($mid);
$comNum=count($comList);
/*收藏状态*/
$colImg=null;
if($colSta){
    $colImg='star_f.png';
}else{
    $colImg='star_e.png';
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?php echo 'iMovie | '.$movie['name'];?></title>
    <link rel="stylesheet" href="../resources/css/details.css">
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
    <!--基础信息板-->
    <div class="basic-info-container">
        <div class="basic-info">
            <div class="title">
                <h2>
                    <?php echo $movie['name'].'（'.$movie['alias'].'）';?>
                </h2>
            </div>
            <div class="info-container">
                <!--海报-->
                <div class="poster">
                    <img src="<?php echo POSTER_PATH.$movie['cover'];?>">
                </div>
                <!--基础信息板-->
                <div class="infomation">
                    <!--信息表-->
                    <table>
                        <tr>
                        <tr>
                            <td>导&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;演：</td>
                            <td class="t-info"><?php echo $movie['director'];?></td>
                        </tr>
                        <tr>
                            <td>主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;演：</td>
                            <td class="t-info"><?php echo $movie['actor'];?></td>
                        </tr>
                        <tr>
                            <td>时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;长：</td>
                            <td class="t-info"><?php echo $movie['duration'];?></td>
                        </tr>
                        <tr>
                            <td>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：</td>
                            <td class="t-info"><?php echo $movie['origin'];?></td>
                        </tr>
                        <tr>
                            <td>上映时间：</td>
                            <td class="t-info"><?php echo $movie['duration'];?></td>
                        </tr>
                        <tr>
                            <td>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类：</td>
                            <td class="t-info"><?php echo $movie['type'];?></td>
                        </tr>
                        <tr>
                            <td>放映特色：</td>
                            <td class="t-info"><?php echo $movie['characteristic'];?></td>
                        </tr>
                        </tr>
                    </table>
                    <!--按纽-->
                    <div class="bt-column">
                        <a href="<?php echo $movie['buy_link'];?>">
                            <button type="button" id="buy-link"><?php echo $movie['buy_type'];?></button>
                        </a>
                        <div class="collect" >
                            <img id="star" src="<?php echo MATERIAL_PATH.$colImg?>" onclick=collectMovie(<?php echo $mid?>)>
                        </div>
                    </div>
                </div>
                <!--评分-->
                <div class="score">
                    <h3>豆瓣评分</h3>
                    <p id="db-score"><?php echo $movie['score_db'];?> 分</p>
                    <h3>猫眼口碑</h3>
                    <p id="my-score"><?php echo $movie['score_my'];?> 分</p>
                    <h3>淘票票评分</h3>
                    <p id="tpp-score"><?php echo $movie['score_tpp'];?> 分</p>
                    <h3>累计票房</h3>
                    <p id="income"><?php echo $movie['income'];?></p>
                </div>
            </div>
        </div>
    </div>
    <!--正文部分-->
    <div class="container">
        <!--正文-->
        <div class="text-container">
            <!--预告片-->
            <div class="preview">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'video-one.png';?>">
                    <p>电影预告</p>
                </div>
                <div class="content">
                    <video id="preview-video" controls >
                        <source src="<?php echo VIDEO_PATH.$movie['preview'];?>" type="video/mp4">
                    </video>
                </div>
            </div>
            <!--剧情简介-->
            <div class="plot">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'doc-detail.png';?>">
                    <p>剧情简介</p>
                </div>
                <div class="content">
                    <?php
                        echo $movie['introduction'];
                    ?>
                </div>
            </div>
            <!--基础信息-->
            <div class="basic-information">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'info.png';?>">
                    <p>基础信息</p>
                </div>
                <div class="content" id="basic-information-table">
                    <table>
                        <tr>
                            <td>片名</td>
                            <td class="t-info"><?php echo $movie['name'];?></td>
                        </tr>
                        <tr>
                            <td>外文名</td>
                            <td class="t-info"><?php echo $movie['alias'];?></td>
                        </tr>
                        <tr>
                            <td>类型</td>
                            <td class="t-info"><?php echo $movie['type'];?></td>
                        </tr>
                        <tr>
                            <td>版本</td>
                            <td class="t-info"><?php echo $movie['version'];?></td>
                        </tr>
                        <tr>
                            <td>语言</td>
                            <td class="t-info"><?php echo $movie['language'];?></td>
                        </tr>
                        <tr>
                            <td>时长</td>
                            <td class="t-info"><?php echo $movie['duration'];?></td>
                        </tr>
                        <tr>
                            <td>片源地</td>
                            <td class="t-info"><?php echo $movie['origin'];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--海报-->
            <div class="poster-down">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'pic.png';?>">
                    <p>海报</p>
                </div>
                <div class="content">
                    <table>
                        <tr>
                            <td class="poster-img">海报</td>
                            <td class="poster-operate">操作</td>
                        </tr>
                        <?php
                        for($pid=0;$pid<$picNum;$pid++){

                        ?>
                        <tr>
                            <td class="poster-img">
                                <img src="<?php echo POSTER_PATH.$picList[$pid]['path'];?>">
                            </td>
                            <td class="poster-operate">
                                <button onclick="showBigPic('<?php echo $picList[$pid]['path'];?>')" class="poster-down-button">查看大图</button>
                                <a href="<?php echo POSTER_PATH.$picList[$pid]['path'];?>" download="">
                                    <button class="poster-down-button">下载</button>
                                </a>
                                <input type="button" value="点赞（<?php echo $picList[$pid]['like'];?>）" class="poster-down-button" id="like<?php echo $picList[$pid]['pid'];?>" onclick="like(<?php echo $picList[$pid]['pid'];?>)">
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <!--评论-->
            <div class="evaluation">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'评论_comment.png';?>">
                    <p>评论</p>
                </div>
                <div class="content">
                    <?php
                        if($comNum<=0){
                            echo '暂无评论';
                        }else{
                        $k=min(20,$comNum);
                        for ($i=0;$i<$comNum;$i++){
                            //获取单挑评论
                            $com=$comList[$i];
                            $comUser=$userDao->selectUserByUid($com['uid'])[0];
                    ?>
                    <div class="acom">
                        <div class="commenter">
                            <div class="commenter-name">
                                <?php echo $comUser['name'];?>
                            </div>
                            <div class="comment-score">
                                <?php echo $com['score'].'分';?>
                            </div>
                            <div class="comment-time">
                                <?php echo $com['createTime'];?>
                            </div>
                        </div>
                        <div class="comment-msg">
                            <?php echo $com['comment']?>
                        </div>
                    </div>
                    <?php }}?>
                </div>
            </div>
            <!--观影记录登记-->
            <div class="record">
                <div class="subheading">
                    <img src="<?php echo MATERIAL_PATH.'history.png';?>">
                    <p>观影记录</p>
                </div>
                <div class="content">
                    <form class="my-record" method="post" id="comform" onsubmit=mycomment()>
                        <table>
                            <tr>
                                <td class="record-title">
                                    观影时间
                                </td>
                                <td class="record-content">
                                    <input type="date" name="time" id="Viewingtime">
                                </td>
                            </tr>
                            <tr>
                                <td class="record-title">
                                    观影方式
                                </td>
                                <td class="record-content">
                                    <input type="text" id="way" name="way" placeholder="线上/线下">
                                </td>
                            </tr>
                            <tr>
                                <td class="record-title">
                                    观影平台/影院
                                </td>
                                <td class="record-content">
                                    <input type="text" name="platform" id="platform">
                                </td>
                            </tr>
                            <tr>
                                <td class="record-title">
                                    您的评分
                                </td>
                                <td class="record-content">
                                    <input type="number" min="0" max="10" value="10" name="score" id="score" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="record-title">
                                    您的评价
                                </td>
                                <td class="record-content">
                                    <input type="text" id="comment" name="comment" required style="width: 800px">
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="mid" name="mid" value="<?php echo $movie['mid']?>" required>
                        <input type="submit" value="提交" id="submit-record" >
                    </form>
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