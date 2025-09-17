<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Services\OrganizedLogger;

class CheckAndFixLogs extends Command
{
    protected $signature = 'admin:check-logs {--fix : Also fix found errors}';
    protected $description = 'Check organized logs for errors and optionally fix them';

    public function handle()
    {
        $shouldFix = $this->option('fix');

        $this->info('🔍 Sprawdzam zorganizowane logi...');
        $this->line('');

        $logsPath = storage_path('logs');
        $errorFiles = glob($logsPath . '/error_*.log');
        $warningFiles = glob($logsPath . '/warning_*.log');

        // Sort files chronologically (oldest first)
        sort($errorFiles);
        sort($warningFiles);

        if (empty($errorFiles) && empty($warningFiles)) {
            $this->info('✅ Brak plików z błędami lub ostrzeżeniami.');
            return;
        }

        // Check error files
        if (!empty($errorFiles)) {
            $this->line('🚨 Znalezione pliki błędów:');
            foreach ($errorFiles as $file) {
                $basename = basename($file);
                $content = file_get_contents($file);
                $lineCount = substr_count($content, "\n");

                $this->line("   📄 {$basename} ({$lineCount} wpisów)");

                if ($shouldFix && !empty(trim($content))) {
                    $this->line("      🔧 Analizuję błędy...");
                    $this->analyzeAndFixErrors($content);
                }
            }
            $this->line('');
        }

        // Check warning files
        if (!empty($warningFiles)) {
            $this->line('⚠️  Znalezione pliki ostrzeżeń:');
            foreach ($warningFiles as $file) {
                $basename = basename($file);
                $content = file_get_contents($file);
                $lineCount = substr_count($content, "\n");

                $this->line("   📄 {$basename} ({$lineCount} wpisów)");
            }
            $this->line('');
        }

        if (!$shouldFix) {
            $this->info('💡 Użyj --fix aby naprawić znalezione błędy');
            $this->info('   Przykład: php artisan admin:check-logs --fix');
        }
    }

    private function analyzeAndFixErrors($content)
    {
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            // Pattern matching for common Laravel errors
            if (preg_match('/View \[([^\]]+)\] not found/', $line, $matches)) {
                $viewName = $matches[1];
                $this->info("      📝 Tworzę brakujący widok: {$viewName}");
                $this->createMissingView($viewName);
            }

            if (preg_match('/Route \[([^\]]+)\] not defined/', $line, $matches)) {
                $routeName = $matches[1];
                $this->info("      🛣️  Znaleziono brakującą trasę: {$routeName}");
            }

            if (preg_match('/Class [\'"]([^\'"]+)[\'"] not found/', $line, $matches)) {
                $className = $matches[1];
                $this->info("      🏗️  Znaleziono brakującą klasę: {$className}");
            }
        }

        OrganizedLogger::info("Checked and fixed errors from organized logs");
    }

    private function createMissingView($viewName)
    {
        $viewPath = str_replace('.', '/', $viewName) . '.blade.php';
        $fullPath = resource_path('views/' . $viewPath);

        if (File::exists($fullPath)) {
            return;
        }

        File::ensureDirectoryExists(dirname($fullPath));

        $content = $this->generateViewContent($viewName);
        File::put($fullPath, $content);

        OrganizedLogger::info("Created missing view: {$viewName}");
    }

    private function generateViewContent($viewName)
    {
        $parts = explode('.', $viewName);
        $title = ucfirst(end($parts));

        return "@extends('layouts.admin')

@section('title', '{$title} - Global Synlogia')
@section('page-title', '{$title}')

@section('content')
<div class=\"bg-white shadow-lg rounded-lg p-6\">
    <h3 class=\"text-lg font-medium text-[#124f9e] mb-4\">{$title}</h3>
    <p class=\"text-gray-600\">Ta strona została automatycznie wygenerowana.</p>
</div>
@endsection
";
    }
}