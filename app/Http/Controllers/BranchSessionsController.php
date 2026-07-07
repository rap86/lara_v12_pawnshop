<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchSessionsController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'branch_id' => 'nullable|exists:branches,id' // Allow null for "All Branches"
        ]);

        // Save the selected branch ID into the user's session
        session(['active_branch_id' => $request->branch_id]);

        return back()->with('flash_success', 'Branch switched successfully!');
    }
}
