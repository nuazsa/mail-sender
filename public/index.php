<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nuazsa\MailSender\Controller\SenderController;
use Nuazsa\MailSender\Services\Env;
use Nuazsa\MailSender\Services\Router;


Router::get('/', SenderController::class, 'sender');
Router::post('/send', SenderController::class, 'send');

Env::run();
Router::run();