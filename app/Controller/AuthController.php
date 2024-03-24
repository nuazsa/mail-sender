<?php

namespace Nuazsa\MailSender\Controller;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Nuazsa\MailSender\Services\View;
use Nuazsa\MailSender\Config\Connection;

class AuthController
{
    public string $name;
    public string $email;
    public string $pass;
    public string $repass;
    public string $token;

    public function register()
    {
        // Mendapatkan koneksi ke database
        $connection = Connection::getConnection();

        if (isset($_POST['send'])) {

            $this->name = $_POST['name'];
            $this->email = $_POST['email'];
            $this->pass = $_POST['password'];
            $this->repass = $_POST['repassword'];

            if ($this->pass != $this->repass) {
                $model = [
                    'title' => 'Register',
                    'message' => 'password tidak valid'
                ];

                View::render('version2/signin', $model);
                exit;
            }

            $stmt = $connection->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            if ($stmt->fetch()) {
                $model = [
                    'title' => 'Register',
                    'message' => 'email sudah digunakan'
                ];

                View::render('version2/signin', $model);
                exit;
            }


            // Generate token
            $this->token = $this->generateToken();

            // Query SQL dengan prepared statement
            $stmt = $connection->prepare("INSERT INTO users(name, email, password, tokenVerified) VALUES (:name, :email, :password, :tokenVerified)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->pass);
            $stmt->bindParam(':tokenVerified', $this->token);

            // Eksekusi statement
            $stmt->execute();
            $this->sending();

            $connection = null;

            session_start();
            $_SESSION['email'] = $this->email;
            // Registrasi berhasil, tampilkan alert
            echo "<script>alert('Registrasi berhasil. Silakan masukkan token.');</script>";
            header('Location: token');
        }

        $model = [
            'title' => 'Register'
        ];

        View::render('version2/signin', $model);
    }

    private function generateToken()
    {
        $token = '';
        for ($i = 0; $i < 5; $i++) {
            $token .= rand(0, 9);
        }
        return $token;
    }

    public function sending()
    {

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
            $mail->setFrom('noreply@gmail.com', 'Authentication');
            $mail->addAddress($this->email, $this->name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Login Autentication';
            $mail->Body    = "Token: $this->token";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    public function token()
    {
        // Mendapatkan koneksi ke database
        $connection = Connection::getConnection();

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: signin');
        }

        if (isset($_POST['send_token'])) {
            $token = $_POST['token'];

            $stmt = $connection->prepare("SELECT * FROM users WHERE tokenVerified = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if ($row = $stmt->fetch()) {
                if (isset($_SESSION['email']) && $token == $row['tokenVerified']) {
                    // Token sesuai, lakukan proses verifikasi di database
                    $stmt = $connection->prepare("UPDATE `users` SET `tokenVerified`= null WHERE tokenVerified = :token");
                    $stmt->bindParam(':token', $token);
                    $stmt->execute();

                    echo "<script>alert('Token berhasil diverivikasi. Silakan login.');</script>";
                    header('Location: login');
                    session_unset();
                    session_destroy();
                    exit;
                }
            } else {
                $model = [
                    'title' => 'Verified',
                    'message' => 'token tidak valid'
                ];
                View::render('version2/token', $model);
                exit;
            }
        }

        $model = [
            'title' => 'Verified'
        ];
        View::render('version2/token', $model);
    }

    public function login()
    {
        $model = [
            'title' => 'Login'
        ];
        View::render('version2/login', $model);
    }

    public function loginVerified()
    {
        // Mendapatkan koneksi ke database
        $connection = Connection::getConnection();

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row && $row['tokenVerified'] !== NULL) {
            $model = [
                'title' => 'Login',
                'message' => 'token belum di registrasi'
            ];
            View::render('version2/login', $model);
            exit;
        }

        if ($row && $row['tokenVerified'] === NULL) {
            session_start();

            // Menyimpan data user ke session
            $_SESSION['user'] = [
                'name' => $row['name'],
                'email' => $row['email']
            ];


            header('Location: home');
            exit;
        } else {
            $model = [
                'title' => 'Login',
                'message' => 'email/password salah'
            ];
            View::render('version2/login', $model);
        }
    }

    public function logout()
    {
        session_start();

        session_unset();
        session_destroy();

        header('Location: /version2/signin');
        exit;
    }
}
