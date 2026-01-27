<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($quotation) {
            if (empty($quotation->quotationno)) {
                $lastQuotation = static::withTrashed()->orderBy('id', 'desc')->first();
                $nextId = $lastQuotation ? $lastQuotation->id + 1 : 1;
                $quotation->quotationno = 'QUO' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
            }
        });
    }

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
