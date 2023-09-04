<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'company_name' => 'string',
        'company_address' => 'string',
        'services' => 'array'
    ];

    protected $fillable = [
        'company_uuid',
        'company_name',
        'company_phone',
        'company_address',
        'company_email',
        'RC_number',
        'no_of_staff',
        'about_company',
        'services',
        'admin_name',
        'admin_email',
        'admin_user',
        'logo',
        'status',

    ];


}
