<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSettingsController extends Controller
{
    /**
     * Display a listing of the API settings.
     */
    public function index()
    {
        // Order by active status first, then by priority
        $apiSettings = ApiSetting::orderByDesc('is_active')
            ->orderBy('priority')
            ->get();

        return view('api_settings.index', compact('apiSettings'));
    }

    /**
     * Show the form for creating a new API setting.
     */
    public function create()
    {
        return view('api_settings.create');
    }

    /**
     * Store a newly created API setting in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_provider' => 'required|string|max:100',
            'api_type'         => 'required|string|max:50', // e.g., 'telegram', 'sms'
            'unique_code'      => 'required|string|max:50|unique:api_settings,unique_code',
            'base_url'         => 'nullable|url|max:255',
            'api_key'          => 'nullable|string',
            'auth_token'       => 'nullable|string',
            'config_payload'   => 'nullable|json', // Validates it is a proper JSON string
            'environment'      => 'required|in:sandbox,production',
            'priority'         => 'nullable|integer',
        ]);

        // Safely extract boolean values from checkboxes
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_fallback'] = $request->boolean('is_fallback');

        // Automatically decode the JSON string into an array so the Model's 'array' cast can handle it
        if (!empty($validated['config_payload'])) {
            $validated['config_payload'] = json_decode($validated['config_payload'], true);
        }

        DB::transaction(function () use ($validated) {
            // Enterprise Rule: If this is set as the fallback, remove fallback status from all others
            if ($validated['is_fallback']) {
                ApiSetting::where('is_fallback', true)->update(['is_fallback' => false]);
            }

            ApiSetting::create($validated);
        });

        return redirect()->route('api_settings.index')
            ->with('flash_success', "API Setting for {$validated['service_provider']} created successfully.");
    }

    /**
     * Display the specified API setting details.
     */
    public function show(ApiSetting $apiSetting)
    {
        // Note: Do not expose decrypted api_key or auth_token to the view directly unless necessary
        return view('api_settings.show', compact('apiSetting'));
    }

    /**
     * Show the form for editing the specified API setting.
     */
    public function edit(ApiSetting $apiSetting)
    {
        return view('api_settings.edit', compact('apiSetting'));
    }

    /**
     * Update the specified API setting in the database.
     */
    public function update(Request $request, ApiSetting $apiSetting)
    {
        $validated = $request->validate([
            'service_provider' => 'required|string|max:100',
            'api_type'         => 'required|string|max:50',
            // Ignore the current record's ID for the unique check
            'unique_code'      => 'required|string|max:50|unique:api_settings,unique_code,' . $apiSetting->id,
            'base_url'         => 'nullable|url|max:255',
            'api_key'          => 'nullable|string',
            'auth_token'       => 'nullable|string',
            'config_payload'   => 'nullable|json',
            'environment'      => 'required|in:sandbox,production',
            'priority'         => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_fallback'] = $request->boolean('is_fallback');

        if (!empty($validated['config_payload'])) {
            $validated['config_payload'] = json_decode($validated['config_payload'], true);
        }

        DB::transaction(function () use ($validated, $apiSetting) {
            // Enterprise Rule: Enforce single fallback global rule
            if ($validated['is_fallback'] && !$apiSetting->is_fallback) {
                ApiSetting::where('id', '!=', $apiSetting->id)->update(['is_fallback' => false]);
            }

            $apiSetting->update($validated);
        });

        return redirect()->route('api_settings.show',$apiSetting->id)
            ->with('flash_success', "API Setting for {$apiSetting->service_provider} updated successfully.");
    }

    /**
     * Remove the specified API setting from the database.
     */
    public function destroy(ApiSetting $apiSetting)
    {
        // Safety check: Don't allow deleting the only active fallback
        if ($apiSetting->is_fallback && ApiSetting::where('is_fallback', true)->count() === 1) {
            return redirect()->route('api_settings.index')
                ->with('flash_failure', 'Cannot delete the primary fallback gateway. Reassign fallback status to another gateway first.');
        }

        $apiSetting->delete();

        return redirect()->route('api_settings.index')
            ->with('flash_success', 'API Setting removed successfully.');
    }
}
