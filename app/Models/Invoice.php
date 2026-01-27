<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoiceno',
        'invoicedate',
        'customer_id',
        'total',
        'cgst',
        'sgst',
        'intrastate',
        'shipping_id',
    ];

    protected $casts = [
        'invoicedate' => 'date',
        'total' => 'decimal:2',
        'cgst' => 'decimal:2',
        'sgst' => 'decimal:2',
        'intrastate' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the customer associated with the invoice.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the invoice items for this invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
