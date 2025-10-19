<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $testimonials = Testimonial::paginate(8);

        return view('auth.register', compact('testimonials'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'string', 'exists:users,referral_code'],
        ]);

        // Fetch the referred user ID if the referral code is valid
        $referredBy = null;
        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
            if ($referrer) {
                $referredBy = $referrer->referral_code;
            }
        }

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->name,
            'last_name' => $request->name,
            'user_type' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => User::generateReferralCode(),
            'referred_by' => $referredBy,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('redirect', absolute: false));
    }
}
