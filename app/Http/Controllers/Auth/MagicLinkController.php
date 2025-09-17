<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MagicLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class MagicLinkController extends Controller
{

    /**
     * Show the magic link request form
     */
    public function showLinkRequestForm()
    {
        return view('auth.magic-link');
    }

    /**
     * Send a magic link to the user's email
     */
    public function sendMagicLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Create or find user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => explode('@', $email)[0], // Use email prefix as default name
                'password' => bcrypt(Str::random(32)) // Random password for magic link users
            ]
        );

        // Create magic link
        $magicLink = MagicLink::createForEmail(
            $email,
            $request->ip(),
            $request->userAgent()
        );

        // Send email with magic link
        Mail::send('emails.magic-link', [
            'magicLink' => $magicLink,
            'user' => $user,
        ], function ($message) use ($email) {
            $message->to($email)
                    ->subject('Twój link logowania - Global Synlogia');
        });

        return back()->with('success', 'Link logowania został wysłany na Twój adres email.');
    }

    /**
     * Verify magic link and log user in
     */
    public function verifyMagicLink(Request $request, string $token)
    {
        $magicLink = MagicLink::findValidToken($token);

        if (!$magicLink) {
            return redirect('/login')
                ->with('error', 'Link logowania jest nieprawidłowy lub wygasł.');
        }

        // Find user
        $user = User::where('email', $magicLink->email)->first();

        if (!$user) {
            return redirect('/login')
                ->with('error', 'Nie znaleziono użytkownika.');
        }

        // Mark magic link as used
        $magicLink->markAsUsed();

        // Log user in
        Auth::login($user);

        return redirect()->intended('/dashboard')
            ->with('success', 'Zalogowano pomyślnie!');
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Wylogowano pomyślnie.');
    }
}
