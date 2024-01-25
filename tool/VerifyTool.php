<?php
//创建画布
$image = imagecreatetruecolor(100, 30);
//背景颜色
$bgcolor = imagecolorallocate($image, 255, 255, 255);
//填充颜色
imagefill($image, 0, 0, $bgcolor);
//验证码内容
$content = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $fontsize = 10;
    $fontcolor = imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
    $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
    $captcha .= $fontcontent;
    //坐标
    $x = ($i * 100 / 4) + mt_rand(5, 10);
    $y = mt_rand(5, 10);
    imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
}
$_SESSION["verifyimg"] = $captcha;
//背景干扰
//像素点
for ($$i = 0; $i < 200; $i++) {
    $pointcolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
    imagesetpixel($image, mt_rand(1, 99), mt_rand(1, 29), $pointcolor);
}
//线
for ($i = 0; $i < 3; $i++) {
    $linecolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
    imageline($image, mt_rand(1, 99), mt_rand(1, 29), mt_rand(1, 99), mt_rand(1, 29), $linecolor);
}
//输出图片头信息
header('content-type:image/png');
//输出图片
imagepng($image);
//销毁图片
imagedestroy($image);

