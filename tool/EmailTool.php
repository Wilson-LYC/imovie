<?php

require_once '../tool/PHPMailer/PHPMailer.php';
require_once '../tool/PHPMailer/SMTP.php';

use PHPMailer\tool\PHPMailer\PHPMailer;

class EmailTool

{
    public static $HOST = 'smtp.qq.com'; //邮箱的服务器地址
    public static $PORT = 465; // smtp服务器的远程服务器端口号
    public static $SMTP = 'ssl'; // 使用ssl加密方式登录
    public static $CHARSET = 'UTF-8'; //设置发送的邮件的编码
    private static $USERNAME = 'wilson_lyc@foxmail.com'; // 授权登录的账号
    private static $PASSWORD = 'blnfkzecutkebahg'; // 授权登录的密码
    private static $NICKNAME = 'iMovie爱电影'; // 发件人的昵称

    public function __construct($debug = false){
        $this->mailer = new PHPMailer();
        $this->mailer->SMTPDebug = $debug ? 1 : 0;
        $this->mailer->isSMTP(); // 使用 SMTP 方式发送邮件
    }
    /**
     * @return PHPMailer
     */
    public function getMailer(){
            return $this->mailer;
    }
    /**
     * 加载配置
    */
    private function loadConfig(){
        /* Server Settings  */
        $this->mailer->SMTPAuth = true; // 开启 SMTP 认证
        $this->mailer->Host = self::$HOST; // SMTP 服务器地址
        $this->mailer->Port = self::$PORT; // 远程服务器端口号
        $this->mailer->SMTPSecure = self::$SMTP; // 登录认证方式
        /* Account Settings */
        $this->mailer->Username = self::$USERNAME; // SMTP 登录账号
        $this->mailer->Password = self::$PASSWORD; // SMTP 登录密码
        $this->mailer->From = self::$USERNAME; // 发件人邮箱地址
        $this->mailer->FromName = self::$NICKNAME; // 发件人昵称（任意内容）
        /* Content Setting  */
        $this->mailer->isHTML(true); // 邮件正文是否为 HTML
        $this->mailer->CharSet = self::$CHARSET; // 发送的邮件的编码
    }

    /**
     * 发送邮件
     * @param string $email 收件人邮箱
     * @param string $title 邮件主题
     * @param string $content 邮件内容
     */
    public function send($email, $title, $content){
        $this->loadConfig();
        $this->mailer->addAddress($email); // 收件人邮箱
        $this->mailer->Subject = $title; // 邮件主题
        $this->mailer->Body = $content; // 邮件信息
        return (bool)$this->mailer->send(); // 发送邮件
    }
}