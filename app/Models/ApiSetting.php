<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'api_key'        => 'encrypted',
        'auth_token'     => 'encrypted',
        'config_payload' => 'array',    // Automatically decodes the JSON to a PHP array
        'is_active'      => 'boolean',
        'is_fallback'    => 'boolean',
        'last_used_at'   => 'datetime',
    ];
}
