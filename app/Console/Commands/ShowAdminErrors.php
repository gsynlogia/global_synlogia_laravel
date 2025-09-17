<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowAdminErrors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:errors {--lines=50 : Number of lines to show} {--follow : Follow log file in real-time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show detailed admin errors from logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminLogPath = storage_path('logs/admin.log');
        $laravelLogPath = storage_path('logs/laravel.log');

        $lines = $this->option('lines');
        $follow = $this->option('follow');

        if ($follow) {
            $this->info('Following admin logs in real-time (Ctrl+C to stop)...');
            $this->line('');

            if (file_exists($adminLogPath)) {
                $this->comment('=== ADMIN LOG ===');
                exec("tail -f \"$adminLogPath\"");
            } else {
                $this->warn('Admin log file does not exist yet.');
                $this->comment('=== LARAVEL LOG (Admin-related errors) ===');
                exec("tail -f \"$laravelLogPath\" | grep -i admin");
            }
        } else {
            $this->info("Showing last $lines lines of admin errors:");
            $this->line('');

            // Show admin-specific log if exists
            if (file_exists($adminLogPath)) {
                $this->comment('=== ADMIN LOG ===');
                $adminContent = shell_exec("tail -$lines \"$adminLogPath\"");
                if ($adminContent) {
                    $this->line($adminContent);
                } else {
                    $this->info('No admin errors found.');
                }
                $this->line('');
            }

            // Show admin-related errors from main log
            $this->comment('=== LARAVEL LOG (Admin-related) ===');
            $adminErrors = shell_exec("tail -500 \"$laravelLogPath\" | grep -i -A 5 -B 5 admin | tail -$lines");
            if ($adminErrors) {
                $this->line($adminErrors);
            } else {
                $this->info('No admin-related errors found in main log.');
            }

            // Show recent errors
            $this->line('');
            $this->comment('=== RECENT ERRORS (Last 10) ===');
            $recentErrors = shell_exec("tail -200 \"$laravelLogPath\" | grep -i error | tail -10");
            if ($recentErrors) {
                $this->line($recentErrors);
            } else {
                $this->info('No recent errors found.');
            }
        }
    }
}
