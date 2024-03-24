<?php

namespace Nuazsa\MailSender\Controller;

use Nuazsa\MailSender\Services\View;

class UserController
{
    public function index()
    {
        session_start();

        // Mendapatkan data user dari session
        $user = $_SESSION['user'] ?? null;
        // Check apakah user sudah login
        if (!$user) {
            header('Location: /version2/signin');
            exit;
        }

        // Gunakan data user untuk menampilkan halaman home
        $model = [
            'title' => 'Home',
            'user' => $user
        ];

        View::render('version2/home', $model);
    }

    public function select() 
    {
        $model = [
            'title' => 'Select Version'
        ];

        View::render('index', $model);
    }
}
