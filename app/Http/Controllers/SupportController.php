<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function login(): View
    {
        return view('support.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = Str::lower(trim($request->email));
        $key = 'support-login|' . $email . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => 'Too many attempts. Please try again later.',
            ])->onlyInput('email');
        }

        $configuredEmail = Str::lower((string) config('support.email'));
        $passwordHash = (string) config('support.password_hash');

        if ($configuredEmail === '' || $passwordHash === ''
            || !hash_equals($configuredEmail, $email)
            || !Hash::check($request->password, $passwordHash)) {
            RateLimiter::hit($key, 60);

            return back()->withErrors([
                'email' => 'Invalid support credentials.',
            ])->onlyInput('email');
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();
        $request->session()->put([
            'support_authenticated' => true,
            'support_email' => $configuredEmail,
        ]);

        Log::info('Support portal login', [
            'support_email' => $configuredEmail,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('support.dashboard');
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        if (!$request->session()->boolean('support_authenticated')) {
            return redirect()->route('support.login');
        }

        return view('support.dashboard');
    }

    public function impersonate(Request $request): RedirectResponse
    {
        if (!$request->session()->boolean('support_authenticated')) {
            return redirect()->route('support.login');
        }

        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $student = User::where('email', $request->email)->firstOrFail();
        $privilegedTypes = ['admin', 'admin_manager', 'instructor', 'external_instructor', '1', '2'];

        abort_if(
            in_array((string) $student->user_type, $privilegedTypes, true),
            403,
            'Only student accounts can be accessed through support mode.'
        );
        abort_if($request->session()->has('support_impersonated_student_id'), 409, 'A support session is already active.');

        $request->session()->put([
            'support_impersonated_student_id' => $student->id,
            'support_impersonation_started_at' => now()->toIso8601String(),
        ]);
        $request->session()->regenerate();
        Auth::login($student);

        Log::info('Support started student impersonation', [
            'support_email' => $request->session()->get('support_email'),
            'student_id' => $student->id,
            'student_email' => $student->email,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('user.dashboard');
    }

    public function stopImpersonating(Request $request): RedirectResponse
    {
        if (!$request->session()->boolean('support_authenticated')
            || !$request->session()->has('support_impersonated_student_id')) {
            abort(403, 'No support impersonation session is active.');
        }

        $studentId = $request->session()->pull('support_impersonated_student_id');
        $startedAt = $request->session()->pull('support_impersonation_started_at');

        Log::info('Support ended student impersonation', [
            'support_email' => $request->session()->get('support_email'),
            'student_id' => $studentId,
            'started_at' => $startedAt,
            'ip' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->regenerate();

        return redirect()->route('support.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('support.login');
    }
}
