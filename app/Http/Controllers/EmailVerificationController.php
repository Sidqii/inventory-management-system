<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function verify(Request $request, string $id, string $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            abort(403, 'Invalid verification link.');
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return view('auth.verify-success');
    }

    public function resend(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email', 'exists:users, email']
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.'
            ]);
        }

        $key = Str::lower($user->email) . '|verification-email';

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return response()->json([
                'message' => 'Too many varification email requests. Please try again later.',
                'available_in_seconds' => RateLimiter::availableIn($key),
            ]);
        }

        RateLimiter::hit($key, 60);

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification link has been sent.'
        ]);
    }
}
