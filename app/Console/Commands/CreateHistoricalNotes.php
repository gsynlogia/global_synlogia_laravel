<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\MagicLink;
use Illuminate\Console\Command;

class CreateHistoricalNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create-historical-notes {--force : Force creation even if notes already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create historical notes for existing users based on their account creation and first login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');

        $users = User::with('notes')->get();
        $this->info("Przetwarzanie {$users->count()} użytkowników...");

        $created = 0;
        $skipped = 0;

        foreach ($users as $user) {
            // Skip if user already has notes and not forcing
            if (!$force && $user->notes->count() > 0) {
                $skipped++;
                continue;
            }

            // Create account creation note
            if ($force || !$user->notes()->where('type', 'system')->where('title', 'like', '%Konto utworzone%')->exists()) {
                $user->notes()->create([
                    'type' => 'system',
                    'title' => 'Konto utworzone',
                    'content' => 'Konto użytkownika zostało utworzone w systemie.',
                    'metadata' => [
                        'registration_method' => 'legacy',
                        'created_at' => $user->created_at->toISOString(),
                        'migrated_note' => true
                    ],
                    'created_by' => $user->id, // Use the user's own ID for historical notes
                    'created_at' => $user->created_at,
                    'updated_at' => $user->created_at
                ]);
                $created++;
            }

            // Check for first magic link usage
            $firstMagicLink = MagicLink::where('email', $user->email)
                ->where('used_at', '!=', null)
                ->orderBy('used_at')
                ->first();

            if ($firstMagicLink && ($force || !$user->notes()->where('type', 'login')->exists())) {
                $user->notes()->create([
                    'type' => 'login',
                    'title' => 'Pierwsze logowanie',
                    'content' => 'Użytkownik zalogował się po raz pierwszy, aktywując swoje konto.',
                    'metadata' => [
                        'magic_link_token' => $firstMagicLink->token,
                        'is_first_login' => true,
                        'login_time' => $firstMagicLink->used_at->toISOString(),
                        'migrated_note' => true
                    ],
                    'created_by' => $user->id,
                    'created_at' => $firstMagicLink->used_at,
                    'updated_at' => $firstMagicLink->used_at
                ]);
                $created++;
            }
        }

        $this->info("Ukończono! Utworzono {$created} notatek historycznych.");
        $this->info("Pominięto {$skipped} użytkowników (już mają notatki).");

        if ($skipped > 0 && !$force) {
            $this->comment("Użyj --force aby nadpisać istniejące notatki.");
        }
    }
}
