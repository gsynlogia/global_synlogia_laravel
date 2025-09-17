<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Log\LogManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('log.organized', function ($app) {
            $logger = new LogManager($app);

            // Configure channels for organized logging
            $logger->extend('organized_error', function ($app, $config) {
                $path = storage_path('logs/error_' . date('Y-m-d') . '.log');
                $handler = new StreamHandler($path, Logger::ERROR);
                return new Logger('organized_error', [$handler]);
            });

            $logger->extend('organized_warning', function ($app, $config) {
                $path = storage_path('logs/warning_' . date('Y-m-d') . '.log');
                $handler = new StreamHandler($path, Logger::WARNING);
                return new Logger('organized_warning', [$handler]);
            });

            $logger->extend('organized_info', function ($app, $config) {
                $path = storage_path('logs/info_' . date('Y-m-d') . '.log');
                $handler = new StreamHandler($path, Logger::INFO);
                return new Logger('organized_info', [$handler]);
            });

            return $logger;
        });
    }

    public function boot()
    {
        //
    }
}