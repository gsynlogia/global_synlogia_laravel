<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class OrganizedLogger
{
    public static function log($level, $message)
    {
        $dateTimeMinute = date('Y-m-d_H-i');
        $timestamp = date('Y-m-d H:i:s');

        $filename = "storage/logs/{$level}_{$dateTimeMinute}.log";
        $logEntry = "[{$timestamp}] {$level}.{$level}: {$message}" . PHP_EOL;

        File::append(base_path($filename), $logEntry);
    }

    public static function error($message)
    {
        self::log('error', $message);
    }

    public static function warning($message)
    {
        self::log('warning', $message);
    }

    public static function info($message)
    {
        self::log('info', $message);
    }
}