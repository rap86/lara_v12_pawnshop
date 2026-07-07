<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

                // 1. Split out of the ternary operator to satisfy Intelephense
                if ($user->role === 'admin' || $user->is_floating) {
                    $allowedBranches = Branch::all();
                } else {
                    /** @diagnostic ignore: undefined_property */
                    $allowedBranches = Branch::where('id', $user->branch_id)->get();
                }

                // 2. Determine which branch is currently "active" in the session
                /** @diagnostic ignore: undefined_property */
                $activeBranchId = session('active_branch_id', $user->branch_id);
                $currentBranch = !empty($activeBranchId) ? Branch::find($activeBranchId) : null;

                // Share variables with your Blade files
                $view->with([
                    'sidebarBranches' => $allowedBranches,
                    'currentBranch' => $currentBranch
                ]);
            }
        });
    }

}
