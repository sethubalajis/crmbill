<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quotationno',
        'date',
        'customer_id',
        'total',
        'gstcentral',
        'intrastate',
        'gststate',
    ];

    protected $casts = [
        'date' => 'date',
        'intrastate' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function quotationitems(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}
