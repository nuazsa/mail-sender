<?php

namespace Nuazsa\MailSender\Controller;

use Nuazsa\MailSender\Services\Env;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Nuazsa\MailSender\Services\View;


class SenderController
{
    public function sender()
    {
        $model = [
            'title' => 'Mail Sender'
        ];

        View::render('version1', $model);
    }

    public function send()
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']); 
        $message = htmlspecialchars($_POST['messege']);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nurazissaputra@gmail.com';
            $mail->Password   = Env::get('SECRET_KEY');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('nurazissaputra@gmail.com', 'Mailer');
            $mail->addAddress($email, $name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
