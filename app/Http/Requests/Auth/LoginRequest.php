<?php
namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 1. First, attempt to match the username and password credentials
        if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => 'These credentials do not match our records.',
            ]);
        }

        // 2. Credentials matched! Let's pull the logged-in user object instance
        $user = Auth::user();

        // 3. Verify if their account registry status is set to active
        if ($user && $user->status !== 'active') {
            // Log them out immediately so a session token isn't stored
            Auth::logout();

            // Re-increment throttle penalty metrics for safety
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => 'Your account has been deactivated. Please contact an administrator.',
            ]);
        }

        // 4. Clear Rate Limiter restrictions now that credentials and status are perfect
        RateLimiter::clear($this->throttleKey());

        // 5. Intercept layout for your .env testing flags
        $twoFaTempStatus = env('TWOFA_TEMP_STATUS', 'inactive');

        // 5. Intercept layout for your .env testing flags
        $twoFaTempStatus = env('TWOFA_TEMP_STATUS', 'inactive');

        if ($twoFaTempStatus === 'active') {
            // Keep track of who is logging in
            session(['pending_2fa_user' => $user->id]);

            // DO NOT use Auth::logout() here yet if it breaks your session layout.
            // Instead, tell Laravel to drop everything and force-route the browser window.

            abort(redirect('/system_settings/input_code'));
        }

        // If 'inactive', execution terminates normally here and Breeze logs them into the default dashboard.
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('username')).'|'.$this->ip());
    }
}
