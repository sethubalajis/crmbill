<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'item_id',
        'quantity',
        'gst_id',
        'item_rate',
        'item_gst',
        'quotation_id',
    ];

    protected $casts = [
        'item_rate' => 'decimal:2',
        'item_gst' => 'decimal:2',
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function gst(): BelongsTo
    {
        return $this->belongsTo(Gst::class);
    }
}
