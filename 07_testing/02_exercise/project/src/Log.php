<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Config\Directory;

class Log
{
    private static Logger $log;

    public static function init(): void
    {
        $path = Directory::storage() . "app.log";

        self::$log = new Logger('app');
        self::$log->pushHandler(new StreamHandler($path, Logger::DEBUG));
    }

    public static function debug(string $message): void
    {
        self::$log->debug($message);
    }

    public static function info(string $message): void
    {
        self::$log->info($message);
    }

    public static function warning(string $message): void
    {
        self::$log->warning($message);
    }

    public static function error(string $message): void
    {
        self::$log->error($message);
    }
}
