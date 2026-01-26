<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $table = 'customers';

		protected $fillable = [
        'address',
        'companyname',
        'contactname',
        'contactno',
        'country_id',
        'designation',
        'email',
        'gst',
        'pan',
        'postalcode',
        'state_id',
    ];
    
	
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}