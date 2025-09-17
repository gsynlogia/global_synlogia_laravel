<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OrganizedLogger;

class TestOrganizedLogging extends Command
{
    protected $signature = 'test:logging';
    protected $description = 'Test the organized logging system with different log levels';

    public function handle()
    {
        $this->info('Testing organized logging system...');

        $currentMinute = date('Y-m-d_H-i');

        // Test error log
        OrganizedLogger::error('Test error message - ' . now()->format('H:i:s'));
        $this->line('✓ Error logged to: storage/logs/error_' . $currentMinute . '.log');

        // Test warning log
        OrganizedLogger::warning('Test warning message - ' . now()->format('H:i:s'));
        $this->line('✓ Warning logged to: storage/logs/warning_' . $currentMinute . '.log');

        // Test info log
        OrganizedLogger::info('Test info message - ' . now()->format('H:i:s'));
        $this->line('✓ Info logged to: storage/logs/info_' . $currentMinute . '.log');

        $this->newLine();
        $this->info('All logs have been written with date-based filenames!');

        return 0;
    }
}