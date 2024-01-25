<?php
   require_once '../data/config.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>首页</title>
</head>
<body>
    <form action="http://localhost/imovie/service/EmailService.php" method="post" name="test">
        <input type="text" id="email" name="email" placeholder="邮箱">
        <input type="submit" value="提交">
    </form>
</body>
</html>