<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';

    protected $fillable = [
        'invoice_id',
        'item_id',
        'gst_id',
        'quantity',
        'item_rate',
        'item_gst',
        'total',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'item_rate' => 'decimal:2',
        'item_gst' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the invoice associated with this item.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the item associated with this invoice item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the GST associated with this invoice item.
     */
    public function gst()
    {
        return $this->belongsTo(Gst::class);
    }
}
