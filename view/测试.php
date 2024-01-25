<?php
require_once '../data/config.php';
include_once('..'.DS.'dao'.DS.'UserDao.php');
$dao=new UserDao();
$res=$dao->updatePasswordByEmail("wilson_lyc@qq.com","123456");
var_dump($res);