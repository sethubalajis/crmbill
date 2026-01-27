<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'contact_person',
        'designation',
        'email',
        'phone1',
        'phone2',
        'gst_number',
        'pan_number',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
