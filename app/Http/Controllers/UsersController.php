<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        // Fetch users in chunks of 20 per page to keep the application fast
        $users = User::with('branch')->latest('created_at')->paginate(20);
        $branches = Branch::all();

        // Return the view directory passing the users payload
        return view('users.index', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        // 1. Run the separate centralized validation matrix handler
        $validated = $this->validateUserRequest($request);

        // 2. Hash the required password and merge structured 2FA data arrays
        $userData = array_merge($validated, [
            'password' => Hash::make($validated['password']),
        ]);

        // 3. Create the user database entry cleanly using mass assignment
        User::create($userData);

        // 4. Redirect back to the users list view with a success alert
        return redirect()->route('users.index')->with('flash_success', 'New system account registered successfully.');
    }

    public function update(Request $request, $id)
    {
        // 1. Find the user or fail with a 404 error
        $user = User::findOrFail($id);

        // 2. Run validation (If this fails, Laravel automatically redirects back with form errors)
        $validated = $this->validateUserRequest($request, $user);

        try {
            // Save the new password to a temporary variable if it was typed
            $newPassword = $validated['password'] ?? null;

            // Extract password out of the validated parameters array to safeguard fill()
            unset($validated['password']);

            // 3. Update standard profile, destination info, and 2FA choices fields safely
            $user->fill($validated);

            // 4. Update password ONLY if the administrator typed a new one
            if ($request->filled('password')) {
                $user->password = Hash::make($newPassword);
            }

            // 5. Save tracking matrix changes down into database record
            $user->save();

            // 6. Redirect to the detail show view with a success alert
            return redirect()->route('users.show', $user->id)
                            ->with('flash_success', 'System user account updated successfully.');

        } catch (\Exception $e) {
            // 🚨 DATABASE RETRY SHIELD: If something breaks, go back to the edit view with the input and an error message
            return redirect()->route('users.edit', $id)
                            ->withInput()
                            ->with('flash_failure', 'System failed to update account data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $user = User::findOrFail($id);

        return view('users.edit', [
            'user' => $user,
            'branches' => $branches
        ]);
    }

    public function create()
    {
        $branches = Branch::all();
        return view('users.create')->with('branches', $branches);
    }

    /**
     * Remove the specified user record.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Safety Barrier: Prevent a logged-in user from deleting their own account
        if (Auth::id() == $user->id) {
            return redirect()->route('users.index')->with('flash_failure', 'You cannot delete your own profile.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('flash_success', 'User deleted successfully.');
    }

    /**
     * Separate Centralized Validation Matrix Handler
     * Used by both store() and update() to keep configuration rules DRY and secure.
     */
    private function validateUserRequest(Request $request, ?User $user = null): array
    {
        $isUpdate = $user !== null;

        $rules = [
            'name'                => ['required', 'string', 'max:40'],
            'username'            => ['required', 'string', 'max:40', $isUpdate ? Rule::unique('users', 'username')->ignore($user->id) : 'unique:users,username'],
            'email'               => ['required', 'string', 'lowercase', 'email', 'max:255', $isUpdate ? Rule::unique('users', 'email')->ignore($user->id) : 'unique:users,email'],
            'role'                => ['required', 'string'],
            'status'              => ['required', 'string', 'in:active,inactive'],
            'branch_id'           => ['required', 'integer', 'exists:branches,id'],

            // Core Context: Password logic alters dynamically based on create vs edit contexts
            'password'            => $isUpdate ? ['nullable', 'confirmed', Rules\Password::defaults()] : ['required', 'confirmed', Rules\Password::defaults()],

            // New Destination details (Optional coordinates, validated gracefully)
            'phone_number'        => ['nullable', 'string', 'max:50'],
            'chat_id_telegram'    => ['nullable', 'string', 'max:100'],
            'chat_id_viber'       => ['nullable', 'string', 'max:100'],

            // New 2FA Checkbox Preferences (Optional toggles, handled as basic binary flags)
            'is_floating'         => ['nullable', 'boolean'],
            'two_factor_sms'      => ['nullable', 'boolean'],
            'two_factor_gmail'    => ['nullable', 'boolean'],
            'two_factor_yahoo'    => ['nullable', 'boolean'],
            'two_factor_telegram' => ['nullable', 'boolean'],
            'two_factor_viber'    => ['nullable', 'boolean'],
        ];

        $validated = $request->validate($rules);

        // Sanitize check states: Unchecked switch boxes aren't submitted over standard form payloads.
        // We ensure missing fields default cleanly back to false/0 matching the boolean table definition.
        $booleanFields = ['is_floating', 'two_factor_sms', 'two_factor_gmail', 'two_factor_yahoo', 'two_factor_telegram', 'two_factor_viber'];

        foreach ($booleanFields as $field) {
            $validated[$field] = $request->boolean($field);
        }

        return $validated;
    }

    public function show($id)
    {
        // Fetch the user with their branch details or return 404
        $user = User::with('branch')->findOrFail($id);

        return view('users.show', compact('user'));
    }

}
