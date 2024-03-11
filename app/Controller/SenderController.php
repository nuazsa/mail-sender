<?php

namespace Nuazsa\MailSender\Controller;

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

        View::render('version1/sender', $model);
    }

    public function send()
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['messege']);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';          
            $mail->SMTPAuth   = true;                               
            $mail->Username   = 'nurazissaputra@gmail.com';            
            $mail->Password   = '';                    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                

            //Recipients
            $mail->setFrom('nurazissaputra@gmail.com', 'Mailer');
            $mail->addAddress($email, $name);    

            //Content
            $mail->isHTML(true);                        
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $message;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
