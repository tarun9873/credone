<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCreditCard extends Model
{
    protected $fillable = [
    'name',
    'email',
    'mobile_number',
    'pan_number',
    'mother_name',
    'dob',
    'resi_address',
    'company_name',
    'designation',
    'status'
];

}