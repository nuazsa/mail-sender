<?php

use Nuazsa\MailSender\Controller\AuthController;
use Nuazsa\MailSender\Controller\SenderController;
use Nuazsa\MailSender\Controller\UserController;
use Nuazsa\MailSender\Services\Env;
use Nuazsa\MailSender\Services\Router;


Router::get('/', UserController::class, 'select');

Router::get('/version1', SenderController::class, 'sender');
Router::post('/version1', SenderController::class, 'send');

Router::prefix('/version2', function () {
    Router::get('/signin', AuthController::class, 'register');
    Router::post('/signin', AuthController::class, 'register');
    Router::get('/token', AuthController::class, 'token');
    Router::post('/token', AuthController::class, 'token');
    Router::get('/login', AuthController::class, 'login');
    Router::post('/login', AuthController::class, 'loginVerified');
    Router::get('/home', UserController::class, 'index');
    Router::get('/logout', AuthController::class, 'logout');
});

Router::run();