<?php
require_once '../tool/EmailTool.php';//实例化
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email=$_POST['email'];
    echo '<script>alert("'.$email.'")</script>';
    $code=mt_rand(1000,9999);
    $_SESSION['code']=$code;
    $mailer = new EmailTool(false);// 添加附件
    $title = 'iMovie账号激活邮件';// 邮件内容
    $content = '<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .container{
            margin: 0 auto;
            padding: 80px;
            width: 1000px;
            height: auto;
            background: #f5f5f5;
            text-align: center;
        }
        .logo{
            margin: 0 auto;
            width: 500px;
            height: 100px;
            text-align: center;
        }
        .text-container{
            padding: 30px;
            margin: 0 auto;
            width: 800px;
            height: auto;
            background: #ffffff;
            text-align: left;
            border: 1px solid #000000;
            border-radius: 20px;
            margin-bottom: 80px;
        }
        .text-container p{
            margin: 30px 0;
            /*padding-left: 20px;*/
            font-size: 18px;
        }
        #call{
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        #code{
            padding: 0;
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #aaaaaa;
            padding-bottom: 15px;
            margin-bottom: 0;
        }
        #tips{
            margin: 0;
            margin-top: 0px;
            font-size: 16px;
            color: #aaaaaa;
        }
        #copyright{
            margin: 0;
            margin-top: 50px;
            font-size: 14px;
            color: #aaaaaa;
        }
        a{
            text-decoration: none;
            color: #165DFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <a href="http://imovie.ycwisdom.cn">
                <img src="https://mycloud-1313412108.cos.ap-guangzhou.myqcloud.com/logo_2.png" style="height: 90px;width: auto">
            </a>
        </div>
        <div class="text-container">
            <p id="call">尊敬的用户：您好！</p>
            <p>您正在操作iMovie账号，为了您的信息安全，请在验证码输入框中输入：</p>
            <p id="code">'.$code.'</p>
            <p id="tips">注意：此操作将可能为您注册iMovie账号或将您的iMovie账号与此邮箱绑定。如非本人操作，请忽略此消息。</p>
        </div>
        <p class="copyright">Copyright © 2023 iMovie. All rights reserved.</p>
    </div>
</body>
</html>';
// 发送邮件
    $mailer->send($email, $title, $content);
    echo 200;
}
