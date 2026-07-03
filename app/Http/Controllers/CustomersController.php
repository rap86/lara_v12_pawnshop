<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Grab the search term from the query string (?search=...)
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            })
            ->latest()
            // Laravel handles all the math, offsets, and SQL limits behind the scenes
            ->paginate(20)
            ->withQueryString(); // Keeps the search term active while switching pages

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
        $validatedData = $request->validate([
            'first_name'            => 'required|string|max:255',
            'middle_name'           => 'required|string|max:255', // Change to 'nullable' if it's optional
            'last_name'             => 'required|string|max:255',
            'gender'                => 'required|string',
            'address'               => 'required|string',
            'cellphone_number'      => 'required|string',
            // Add rules for your other fields here (e.g., cellphone_number, email)
        ]);

        $customer_id = Customer::create($validatedData)->id;
        return redirect()->route('customers.show', $customer_id)->with('flash_success', 'Customer Details Save.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customers = Customer::findOrFail($id);
        return view('customers.show', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('customers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customers = Customer::findOrFail($id);
        $customers->update($request->all());
        return redirect()->route('customers.show', $id)->with('flash_success', 'Customer Info updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
