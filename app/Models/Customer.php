<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'marital_status',
        'email',
        'cellphone_number',
        'occupation',
        'address',
        'details',

        // Allow mass assignment on image tracking definitions
        'image_name',
        'image_size',
        'image_location',
        'user_id'
    ];

    // Optional: Protect database mass-assignment anomalies
    protected $guarded = [];
}
