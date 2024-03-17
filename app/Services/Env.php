<?php

namespace Nuazsa\MailSender\Services;

class Env
{
    
    private static $variables;

    public static function run()
    {
        $dotenv = file_get_contents(__DIR__ . '../../../.env');
        $dotenv = preg_replace('/#.*/', '', $dotenv);
        $dotenv = preg_replace('/\s+/', '', $dotenv);
        $lines = explode("\n", $dotenv);

        foreach ($lines as $line) {
            if ($line) {
                list($key, $value) = explode('=', $line, 2);
                self::$variables[$key] = $value;
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
    
    public static function get($key)
    {
        return self::$variables[$key] ?? null;
    }
}
