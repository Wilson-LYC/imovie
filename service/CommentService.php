<?php
require_once '../data/config.php';
$msg=null;
$pic=null;
$link="#";
$linkName='网页';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        include_once '../dao/CommentDao.php';
        $dao=new CommentDao();
        // 获取表单数据
        $time=$_POST['time'];
        $way = $_POST['way'];
        $platform = $_POST['platform'];
        $score = $_POST['score'];
        $comment = $_POST['comment'];
        $uid = $_SESSION['user']['uid'];
        $mid = $_POST['mid'];
        if($dao->addComment($time,$way,$platform,$score,$comment,$uid,$mid)){
            echo 200;
        }
        else
            echo 400;
    }
    else{
        echo 401;
    }
}
else{
    //访问非法，自动跳转
    header('Location:'.VIEW_PATH.'index.php');
}