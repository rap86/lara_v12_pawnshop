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
        $customerCount    = Customer::count();
        $userCount        = User::count();
        $branchCount      = Branch::where('status','active')->count();

        // 2. Send all 3 counts to your view together
        return view('dashboards.index', compact('customerCount', 'userCount', 'branchCount'));
    }
}
