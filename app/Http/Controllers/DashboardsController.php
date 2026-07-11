<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function index()
    {
        // 1. Gather all your counts in one place
        $customerTotalCount    = Customer::count();
        $userTotalCount        = User::count();
        $branchTotalCount      = Branch::count();
        $branchesCounts        = Customer::selectRaw('COALESCE(branches.name, "Main Branch (Global)") as branch_name, count(customers.id) as total')
    ->leftJoin('branches', 'customers.branch_id', '=', 'branches.id')
    ->groupBy('branches.name', 'customers.branch_id')
    ->get();

        // 2. Send all 3 counts to your view together
        return view('dashboards.index', compact(
            'customerTotalCount',
            'userTotalCount',
            'branchTotalCount',
            'branchesCounts'
            ));
    }
}
