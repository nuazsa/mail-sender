<?php

namespace Nuazsa\MailSender\Controller;

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Nuazsa\MailSender\Services\Env;
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

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nurazissaputra@gmail.com';
            $mail->Password   = $_ENV['SECRET_KEY'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('nurazissaputra@gmail.com', 'Mail-Sender');
            $mail->addAddress($email, $name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            $model = [
                'title' => 'Mail Sender',
                'message' => 'Message has been sent'
            ];

            View::render('version1', $model);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
