<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCreditCard extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'dob',
        'pan_number',
        'mother_name',
        'resi_address',
        'mobile_number',
        'email',
        'company_name',
        'designation',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}