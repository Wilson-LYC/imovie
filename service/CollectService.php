<?php
require_once '../data/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        include_once '../dao/CollectDao.php';
        $dao=new CollectDao();
        // 获取表单数据
        $mid=$_POST['mid'];
        $uid=$_SESSION['user']['uid'];
        $mode=null;
        if($dao->selectCollect($uid,$mid)){
            //存在收藏关系，取消收藏
            $mode=0;
        }
        else{
            $mode=1;
        }
        $res=$dao->changeCollect($uid,$mid,$mode);
        if($res)
            echo 200;
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