<?php require_once '../data/config.php'?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>iMovie | 登录</title>
    <link rel="stylesheet" href="../resources/css/LRView.css">
    <link rel="icon" href="../resources/img/material/电影.png" type="image/x-icon">
</head>
<body>
<!--输入框-->
<div class="main">
    <div class="container">
        <div class="logo">
            <a href="<?php echo VIEW_PATH.'index.php'?>">
                <img src="<?php echo MATERIAL_PATH.'logo_2.png'?>">
            </a>
        </div>
        <div class="form-container">
            <div class="f-title">
                用 户 登 录
            </div>
            <div class="user-form-c">
                <form name="login" action="<?php echo SERVICE_PATH.'LoginService.php' ?>"  method="post" class="user-form">
                    <input type="email" placeholder="邮箱" id="email" name="email" required>
                    <input type="password" placeholder="密码" id="password" name="password" required>
                    <input type="text" placeholder="验证码" id="verify" name="verify" value="" required>
                    <img src="../tool/VerifyTool.php" onclick="this.src='../tool/VerifyTool.php?'+new Date().getTime();" width="150" height="60"><br/>
                    <input type="submit" value="登 录" id="submit1">
                </form>
<!--                重置密码-->
                <a href="<?php echo VIEW_PATH.'ResetPassword.php'?>" class="forget">
                    <button class="forget">
                        忘记密码
                    </button>
                </a>
            </div>
            <div class="link">
                没有账户? <a href="register.php">去注册</a>
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
