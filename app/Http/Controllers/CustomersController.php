<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $user = Auth::user();

        // 1. Context setup: Clerks are permanently locked; admins pull from session (defaulting to null)
        $activeBranchId = ($user->role === 'admin' || $user->is_floating)
            ? session('active_branch_id', null)
            : $user->branch_id;

        // 2. Fetch customers
        $customers = Customer::query()
            // If $activeBranchId is null (meaning All Branches), ->when() skips this filter completely
            ->when($activeBranchId, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->latest()
            ->paginate(20);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate incoming data BEFORE hitting the model

        $validatedData = $this->customerFields($request);

        // 2. Inject the ID of the currently logged-in user
        $validatedData['user_id']   = Auth::id();
        $validatedData['branch_id'] = $request->input('branch_id');

        $customer_id = Customer::create($validatedData)->id;
        return redirect()->route('customers.show', $customer_id)->with('flash_success', 'Customer Details Save.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customers = Customer::findOrFail($id);
        //dd($customers);
        return view('customers.show', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // 1. Add validation rules here
        $validatedData = $this->customerFields($request);
        $validatedData['branch_id'] = $request->input('branch_id');

        $customers = Customer::findOrFail($id);

        // 2. Pass ONLY the validated data to the update method
        $customers->update($validatedData);

        return redirect()->route('customers.show', $id)->with('flash_success', 'Customer Info updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function customerFields(Request $request) {

        $validatedData = $request->validate([
            'first_name'       => 'required|string|max:255',
            'middle_name'      => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'gender'           => 'required|string',
            'birthdate'        => 'nullable|date',
            'marital_status'   => 'nullable|string',
            'email'            => 'nullable|string|max:255',
            'cellphone_number' => 'required|string|max:30',
            'occupation'       => 'nullable|string|max:255',
            'address'          => 'required|string|max:500',
            'details'          => 'nullable|string'
        ]);

        return $validatedData;
    }

    public function search(Request $request)
    {
       $user = Auth::user();
    $search = $request->input('search'); // <-- 1. Make sure this matches the form input name

    $customerQuery = Customer::query();

    if ($user->role === 'clerk') {
        $customerQuery->where('branch_id', $user->branch_id);
    }

    if (!empty($search)) {
        $customerQuery->where(function ($subQuery) use ($search) {
            $subQuery->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
        });
    }

    $customers = $customerQuery->latest()
        ->paginate(20)
        ->withQueryString();

    // 2. Double check that 'search' is included here:
    return view('customers.search', compact('customers', 'search'));
    }
}
