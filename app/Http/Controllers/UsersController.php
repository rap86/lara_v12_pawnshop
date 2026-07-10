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
        // Fetch users in chunks of 15 per page to keep the application fast
        $users = User::with('branch')->latest('created_at')->paginate(15);
        $branches = Branch::all();

        // Return the view directory passing the users payload
        return view('users.index', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        // 1. Validate the modal form inputs
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'role'          => ['required', 'string'],
            'status'        => ['required', 'string'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'branch_id'     => ['required', 'integer', 'exists:branches,id'],
        ]);

        // 2. Create the user database entry safely hashing the password
        User::create([
            'name'          => $validated['name'],
            'username'      => $validated['username'],
            'email'         => $validated['email'],
            'role'          => $validated['role'], // Make sure 'role' and 'username' are in your User model's $fillable array!
            'status'        => $validated['status'],
            'password'      => Hash::make($validated['password']),
            'branch_id'     => $validated['branch_id'],
        ]);

        // 3. Redirect back to the users list view with a success alert
        return redirect()->route('users.index')->with('flash_success', 'New system account registered successfully.');
    }

    public function update(Request $request, $id)
    {
        // 1. Find the user or fail with a 404 error
        $user = User::findOrFail($id);

        // 2. Validate the incoming data
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            // Check unique constraint but ignore this user's current username
            'username'      => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            // Check unique constraint but ignore this user's current email
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role'          => ['required', 'string'],
            'status'        => ['required', 'string', 'in:active,inactive'],
            // Password is completely optional here
            'password'      => ['nullable', 'confirmed', Rules\Password::defaults()],
            'branch_id'     => ['required', 'integer', 'exists:branches,id'],
        ]);

        // 3. Update standard profile details
        $user->name         = $validated['name'];
        $user->username     = $validated['username'];
        $user->email        = $validated['email'];
        $user->role         = $validated['role'];
        $user->status       = $validated['status'];
        $user->branch_id    = $validated['branch_id'];

        // 4. Update password ONLY if the admin typed a new one
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // 5. Save the dirty tracking states into the database matrix
        $user->save();

        // 6. Redirect back to your custom index layout view
        return redirect()->route('users.index')->with('flash_success', 'System user account updated successfully.');
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


    /**
     * Remove the specified user record.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Optional Security Check: Prevent a logged-in user from deleting their own account
        if (Auth::id() == $user->id) {
            return redirect()->route('users.index')->with('flash_failure', 'You cannot delete your own profile.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('flash_success', 'User deleted successfully.');
    }
}
