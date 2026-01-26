<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Company extends Model
{
    protected $table = 'companies';

		protected $fillable = [
    'accountname',
        'accountno',
        'address',
        'bankname',
        'country',
        'email',
        'gstinno',
        'ifsc',
        'logo',
        'name',
        'pan',
        'phone',
        'phone2',
        'postalcode',
        'state',
    ];
    
	
}