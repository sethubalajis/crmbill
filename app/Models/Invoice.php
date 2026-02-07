<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($invoice) {
            if (empty($invoice->invoiceno)) {
                $lastInvoice = static::withTrashed()->orderBy('id', 'desc')->first();
                $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
                
                $prefix = Setting::where('key', 'invoice_prefix')->value('value') ?? '';
                $financialYear = Setting::where('key', 'current_financial_year')->value('value');
                $suffix = Setting::where('key', 'invoice_sufix')->value('value') ?? '';
                
				$digits = Setting::where('key', 'invoiceno_digits')->value('value') ?? '';//invoiceno_digits
          	
                $invoice->invoiceno = $prefix . $financialYear . $suffix . str_pad($nextId, intval($digits), '0', STR_PAD_LEFT);
            }
        });
    }

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
