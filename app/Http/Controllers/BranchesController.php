<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchesController extends Controller
{
    public function index()
    {
        // Fetch branches in chunks of 15 per page to keep the application fast
        $branches = Branch::latest('created_at')->paginate(15);

        // Return the view directory passing the branches payload
        return view('branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        // 1. Validate the modal form inputs
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255', 'unique:branches,name'],
            'location' => ['required', 'string', 'max:255'],
            'code'     => ['required', 'string', 'max:20'],
            'status'   => ['required', 'string', 'in:active,inactive']
        ]);

        // 2. Create the branch database entry
        Branch::create([
            'name'     => $validated['name'],
            'location' => $validated['location'],
            'code'     => $validated['code'],
            'status'   => $validated['status']
        ]);

        // 3. Redirect back to the branches list view with a success alert
        return redirect()->route('branches.index')->with('flash_success', 'New branch registered successfully.');
    }

    public function update(Request $request, $id)
    {
        // 1. Find the branch or fail with a 404 error
        $branch = Branch::findOrFail($id);

        // 2. Validate the incoming data
        $validated = $request->validate([
            // Check unique constraint but ignore this branch's current name
            'name'     => ['required', 'string', 'max:255', Rule::unique('branches', 'name')->ignore($branch->id)],
            'location' => ['required', 'string', 'max:255'],
            'code'     => ['required', 'string', 'max:20'],
            'status'   => ['required', 'string', 'in:active,inactive']
        ]);

        // 3. Update standard profile details
        $branch->name     = $validated['name'];
        $branch->location = $validated['location'];
        $branch->code     = $validated['code'];
        $branch->status   = $validated['status'];

        // 4. Save the dirty tracking states into the database matrix
        $branch->save();

        // 5. Redirect back to your custom index layout view
        return redirect()->route('branches.index')->with('flash_success', 'Branch details updated successfully.');
    }

    /**
     * Remove the specified branch record.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->delete();

        return redirect()->route('branches.index')->with('flash_success', 'Branch deleted successfully.');
    }
}
