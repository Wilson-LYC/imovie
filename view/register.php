<?php require_once '../data/config.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iMovie | 注册</title>
    <link rel="stylesheet" href="../resources/css/LRView.css">
    <script src="../resources/js/common.js"></script>
    <link rel="icon" href="../resources/img/material/电影.png" type="image/x-icon">
</head>
<body>
    <!--输入框-->
    <div class="main">
        <div class="container">
            <div class="logo">
                <a href="<?php echo VIEW_PATH."index.php"?>">
                    <img src="<?php echo MATERIAL_PATH.'/logo_2.png'?>">
                </a>
            </div>
            <div class="form-container">
                <div class="f-title">
                    用 户 注 册
                </div>
                <div class="user-form-c">
                    <form name="register" action=<?php echo VIEW_PATH.'code.php' ?>  method="post" class="user-form">
                        <input type="email" placeholder="邮箱" id="email" name="email" required>
                        <input type="text" placeholder="用户名" id="username" name="username" required>
                        <input type="password" placeholder="密码" id="password" name="password" required>
                        <input type="password" placeholder="确认密码" id="password2" name="pass2" required oninput=passCheck("password","password2","passCheck1","submit1")>
                        <p id="passCheck1"></p>
                        <input type="submit" value="注 册" id="submit1">
                    </form>
                </div>
                <div class="link">
                    已有账户? <a href="login.php">去登陆</a>
                </div>
            </div>
        </div>
        <!--页脚-->
        <div class="web-bottom-container">
            <div class="copyright">
                <p>
                    Copyright © 2023 iMovie. All rights reserved.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
