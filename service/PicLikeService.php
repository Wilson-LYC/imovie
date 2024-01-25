<?php
require_once '../data/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        include_once '../dao/MoviePicDao.php';
        $dao=new MoviePicDao();
        // 获取表单数据
        $pid=$_POST['pid'];
        $likeNum = $_POST['likeNum'];
        if($dao->picLikeByPid($pid,$likeNum))
            echo 200;
        else
            echo 400;
    }
    else{
        echo 401;
    }
}else{
    //访问非法，自动跳转至注册页
    header('Location:'.VIEW_PATH.'index.php');
}

