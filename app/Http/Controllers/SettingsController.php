<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::latest('created_at')->paginate(20);
        return view('settings.index')->with('settings', $settings);
    }

    public function store(Request $request)
    {
        // 1. Validate the modal form inputs
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255', 'unique:settings,name'],
            'status'  => ['required', 'string', 'in:active,inactive'],
            'details' => ['required', 'string'], // Textarea input matrix
        ]);

        // 2. Create the setting database entry safely using mass assignment
        Setting::create([
            'name'    => $validated['name'],
            'status'  => $validated['status'],
            'details' => $validated['details'],
        ]);

        // 3. Redirect back to the settings list view with a success alert
        return redirect()->route('settings.index')->with('flash_success', 'New system setting registered successfully.');
    }

    public function update(Request $request, $id)
    {
        // 1. Find the setting or fail with a 404 error
        $setting = Setting::findOrFail($id);

        // 2. Validate the incoming data
        $validated = $request->validate([
            // Check unique constraint but ignore this setting's current name
            'name'    => ['required', 'string', 'max:255', Rule::unique('settings', 'name')->ignore($setting->id)],
            'status'  => ['required', 'string', 'in:active,inactive'],
            'details' => ['required', 'string'], // No max length since it's a textarea/long text
        ]);

        // 3. Update standard profile details
        $setting->name    = $validated['name'];
        $setting->status  = $validated['status'];
        $setting->details = $validated['details'];

        // 4. Save the dirty tracking states into the database matrix
        $setting->save();

        // 5. Redirect back to your custom index layout view
        return redirect()->route('settings.index')->with('flash_success', 'Setting details updated successfully.');
    }

    public function show()
    {
        // Guard clause: kick out users who haven't passed step 1
        if (!session()->has('pending_2fa_user')) {
            return redirect()->route('login');
        }

        return view('settings.show');
    }


    /**
     * 2. Validates the static code and handles the landing page redirect
     * Route: Route::post('/auth/verify-2fa')
     */
    public function input_validation(Request $request)
    {
        $userInputCode = $request->input('full_code');
        $expectedStaticCode = env('TWOFA_TEMP_CODE', '123456');

        if ($userInputCode === $expectedStaticCode) {
            $userId = session('pending_2fa_user');

            // Log the user into your system completely using their stashed ID
            Auth::loginUsingId($userId);

            // Clear out the temporary post-it session variable
            session()->forget('pending_2fa_user');

            // SUCCESS DIRECTION: Go straight to your target landing route
            return redirect()->route('hereafterlogin');
        }

        // FAIL DIRECTION: Keep them here and inject the error alert
        return redirect()->back()->withErrors(['otp' => 'The security code you entered is invalid. Please try again.']);
    }
}
