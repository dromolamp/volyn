<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 19.08.13
 * Time: 15:08
 */

class SendMail {
    /*
     * @param array $to addresses
     * @param string $theme letter
     * @param string $content letter
     */
    public static function send($to, $theme, $content)
    {
        $mailModule = Yii::app()->getModule('mailing');
        $SM = Yii::app()->swiftMailer;
        $Transport = $SM->smtpTransport($mailModule->host, $mailModule->port)
            ->setUsername($mailModule->login)
            ->setPassword($mailModule->password);
        $Mailer = $SM->mailer($Transport);
        $Message = $SM
            ->newMessage($theme)
            ->setFrom(Yii::app()->params['adminEmail'])
            ->setTo($to)
            ->addPart($content, 'text/html');
        return $Mailer->send($Message);
    }
} 