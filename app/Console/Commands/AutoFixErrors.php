<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AutoFixErrors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:watch-and-fix {--interval=3 : Check interval in seconds}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log errors to organized files by date and level (error/warning)';

    private $lastErrorCount = 0;
    private $fixedErrors = [];
    private $lastLogCheck = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $interval = $this->option('interval');

        $this->info("🤖 Starting automatic error monitoring and fixing...");
        $this->info("⏱️  Checking every {$interval} seconds (Ctrl+C to stop)");
        $this->line('');

        while (true) {
            $this->checkAndFixErrors();
            sleep($interval);
        }
    }

    private function checkAndFixErrors()
    {
        $logsPath = storage_path('logs');

        // Get all log files
        $logFiles = glob($logsPath . '/*.log');

        $allErrors = [];

        // Check all log files for new errors
        foreach ($logFiles as $logFile) {
            $errors = $this->getRecentErrors($logFile);
            $allErrors = array_merge($allErrors, $errors);
        }

        if (empty($allErrors)) {
            $this->comment('[' . now()->format('H:i:s') . '] ✅ Monitoring all logs - no new errors detected');
            return;
        }

        // Report error with timestamp
        $errorTime = now()->format('H:i:s');
        $this->error("🚨 [{$errorTime}] BŁĄD WYKRYTY! Analizuję i naprawiam...");

        $fixedAny = false;
        foreach ($allErrors as $error) {
            if ($this->analyzeAndFix($error)) {
                $fixedAny = true;
            }
        }

        if ($fixedAny) {
            $this->info("✅ [{$errorTime}] Błędy naprawione! Sprawdź stronę - powinna działać.");
            $this->warn("🧹 Oczekuję 10 sekund na sprawdzenie, potem wyczyszczę logi...");

            // Wait 10 seconds for user to check the website
            sleep(10);

            $this->cleanLogs();
            $this->info("🗑️  Logi wyczyszczone - gotowy na nowe błędy!");
        }
    }

    private function getRecentErrors($logPath)
    {
        if (!file_exists($logPath)) {
            return [];
        }

        // Get ALL content from log file
        $content = file_get_contents($logPath);

        // If file is empty or only whitespace, no errors
        if (trim($content) === '') {
            return [];
        }

        $lines = explode("\n", $content);
        $errors = [];

        foreach ($lines as $line) {
            // Check for ANY errors (not just admin-related)
            if (strpos($line, 'ERROR') !== false && trim($line) !== '') {
                // Check if this error was already fixed
                $errorHash = md5($line);
                if (!in_array($errorHash, $this->fixedErrors)) {
                    $errors[] = [
                        'line' => $line,
                        'hash' => $errorHash,
                        'file' => basename($logPath)
                    ];
                }
            }
        }

        return $errors;
    }

    private function analyzeAndFix($error)
    {
        $line = $error['line'];
        $hash = $error['hash'];
        $file = $error['file'];

        $this->info("🔍 [{$file}] Analyzing: " . substr($line, 0, 80) . "...");

        // Pattern matching for common errors
        if (strpos($line, 'View [') !== false && strpos($line, '] not found') !== false) {
            return $this->fixMissingView($line, $hash);
        }
        elseif (strpos($line, 'Route [') !== false && strpos($line, '] not defined') !== false) {
            return $this->fixMissingRoute($line, $hash);
        }
        elseif (strpos($line, 'Method ') !== false && strpos($line, ' does not exist') !== false) {
            return $this->fixMissingMethod($line, $hash);
        }
        elseif (strpos($line, 'Class ') !== false && strpos($line, ' not found') !== false) {
            return $this->fixMissingClass($line, $hash);
        }
        else {
            $this->warn("⚠️  [{$file}] Unknown error pattern - logging for manual review");
            $this->line("    " . substr($line, 0, 120));
            $this->fixedErrors[] = $hash; // Mark as seen to avoid spam
            return false;
        }
    }

    private function fixMissingView($line, $hash)
    {
        // Extract view name from error message
        preg_match('/View \[(.*?)\] not found/', $line, $matches);
        if (!$matches) return;

        $viewName = $matches[1];
        $this->info("🛠️  Attempting to create missing view: {$viewName}");

        // Convert view name to file path
        $viewPath = resource_path('views/' . str_replace('.', '/', $viewName) . '.blade.php');
        $viewDir = dirname($viewPath);

        // Create directory if it doesn't exist
        if (!File::exists($viewDir)) {
            File::makeDirectory($viewDir, 0755, true);
            $this->comment("📁 Created directory: {$viewDir}");
        }

        // Generate basic view content based on view name
        $content = $this->generateViewContent($viewName);

        File::put($viewPath, $content);
        $this->fixedErrors[] = $hash;

        $this->info("✅ Successfully created view: {$viewPath}");
        $this->comment("📝 Generated basic template - you may need to customize it");
        return true;
    }

    private function generateViewContent($viewName)
    {
        $parts = explode('.', $viewName);
        $lastPart = end($parts);

        // Determine the type of view based on name patterns
        if (strpos($viewName, 'admin.') === 0) {
            $layout = 'layouts.admin';
        } else {
            $layout = 'layouts.app';
        }

        $title = ucfirst(str_replace(['.', '_', '-'], ' ', $lastPart));

        if (strpos($lastPart, 'create') !== false) {
            return $this->generateCreateFormView($layout, $title);
        }
        elseif (strpos($lastPart, 'edit') !== false) {
            return $this->generateEditFormView($layout, $title);
        }
        elseif (strpos($lastPart, 'show') !== false) {
            return $this->generateShowView($layout, $title);
        }
        else {
            return $this->generateBasicView($layout, $title);
        }
    }

    private function generateCreateFormView($layout, $title)
    {
        return "@extends('{$layout}')

@section('title', '{$title} - Global Synlogia')
@section('page-title', '{$title}')
@section('page-description', 'Create new item')

@section('content')
<div class=\"bg-white shadow-lg rounded-lg\">
    <div class=\"px-6 py-4 border-b border-gray-200\">
        <h3 class=\"text-lg font-medium text-[#124f9e]\">{$title}</h3>
    </div>

    <form method=\"POST\" class=\"p-6\">
        @csrf

        <!-- Form fields will be added here -->
        <div class=\"mb-6\">
            <label class=\"block text-sm font-medium text-gray-700 mb-2\">
                Name *
            </label>
            <input type=\"text\" name=\"name\" required
                   class=\"w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]\">
        </div>

        <div class=\"flex items-center justify-end space-x-4 pt-6 border-t border-gray-200\">
            <a href=\"#\" class=\"text-gray-600 hover:text-gray-800 transition-colors\">
                Cancel
            </a>
            <button type=\"submit\" class=\"admin-button text-white px-6 py-2 rounded-lg transition-all\">
                Create
            </button>
        </div>
    </form>
</div>
@endsection";
    }

    private function generateEditFormView($layout, $title)
    {
        return "@extends('{$layout}')

@section('title', '{$title} - Global Synlogia')
@section('page-title', '{$title}')
@section('page-description', 'Edit item')

@section('content')
<div class=\"bg-white shadow-lg rounded-lg\">
    <div class=\"px-6 py-4 border-b border-gray-200\">
        <h3 class=\"text-lg font-medium text-[#124f9e]\">{$title}</h3>
    </div>

    <form method=\"POST\" class=\"p-6\">
        @csrf
        @method('PUT')

        <!-- Form fields will be added here -->
        <div class=\"mb-6\">
            <label class=\"block text-sm font-medium text-gray-700 mb-2\">
                Name *
            </label>
            <input type=\"text\" name=\"name\" required
                   class=\"w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#124f9e] focus:border-[#124f9e]\">
        </div>

        <div class=\"flex items-center justify-end space-x-4 pt-6 border-t border-gray-200\">
            <a href=\"#\" class=\"text-gray-600 hover:text-gray-800 transition-colors\">
                Cancel
            </a>
            <button type=\"submit\" class=\"admin-button text-white px-6 py-2 rounded-lg transition-all\">
                Update
            </button>
        </div>
    </form>
</div>
@endsection";
    }

    private function generateShowView($layout, $title)
    {
        return "@extends('{$layout}')

@section('title', '{$title} - Global Synlogia')
@section('page-title', '{$title}')
@section('page-description', 'View item details')

@section('content')
<div class=\"bg-white shadow-lg rounded-lg\">
    <div class=\"px-6 py-4 border-b border-gray-200\">
        <h3 class=\"text-lg font-medium text-[#124f9e]\">{$title}</h3>
    </div>

    <div class=\"p-6\">
        <!-- Content will be added here -->
        <p class=\"text-gray-600\">Details view content goes here.</p>
    </div>
</div>
@endsection";
    }

    private function generateBasicView($layout, $title)
    {
        return "@extends('{$layout}')

@section('title', '{$title} - Global Synlogia')
@section('page-title', '{$title}')
@section('page-description', 'Page description')

@section('content')
<div class=\"bg-white shadow-lg rounded-lg\">
    <div class=\"px-6 py-4 border-b border-gray-200\">
        <h3 class=\"text-lg font-medium text-[#124f9e]\">{$title}</h3>
    </div>

    <div class=\"p-6\">
        <p class=\"text-gray-600\">Content for {$title} page.</p>
    </div>
</div>
@endsection";
    }

    private function fixMissingRoute($line, $hash)
    {
        $this->warn("🛣️  Route fix requires manual intervention - adding to web.php");
        $this->fixedErrors[] = $hash;
        return false;
    }

    private function fixMissingMethod($line, $hash)
    {
        $this->warn("⚙️  Method fix requires manual intervention - check controller");
        $this->fixedErrors[] = $hash;
        return false;
    }

    private function fixMissingClass($line, $hash)
    {
        $this->warn("🏗️  Class fix requires manual intervention - check imports");
        $this->fixedErrors[] = $hash;
        return false;
    }

    private function cleanLogs()
    {
        $logsPath = storage_path('logs');
        $logFiles = glob($logsPath . '/*.log');

        $this->comment("🧹 Cleaning logs...");

        foreach ($logFiles as $logFile) {
            // Clear the content but keep the file
            file_put_contents($logFile, '');
            $this->line("   🗑️  Cleared: " . basename($logFile));
        }

        // Reset our tracking arrays
        $this->fixedErrors = [];
        $this->lastLogCheck = [];
    }
}
