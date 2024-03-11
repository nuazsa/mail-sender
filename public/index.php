<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nuazsa\MailSender\Controller\SenderController;
use Nuazsa\MailSender\Services\Router;


Router::get('/sender', SenderController::class, 'sender');
Router::post('/send', SenderController::class, 'send');

Router::run();