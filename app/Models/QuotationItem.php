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
        'total',
        'quotation_id',
    ];

    protected $casts = [
        'item_rate' => 'decimal:2',
        'item_gst' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function booted()
    {
      static::created(function ($model) {
            $model->updateQuotationTotal();
        });

        static::updated(function ($model) {
            $model->updateQuotationTotal();
        });

        static::deleted(function ($model) {
            $model->updateQuotationTotal();
        });
/*static::created(function ($model) {
     $total = $this->quotation->quotationitems()->sum('total');
            $model->quotation?->refreshTotal($total);
        });

        static::updated(function ($model) {
             $total = $this->quotation->quotationitems()->sum('total');
            $model->quotation?->refreshTotal($total);
        });

        static::deleted(function ($model) {
             $total = $this->quotation->quotationitems()->sum('total');
           
        });
*/

    }

    protected function updateQuotationTotal()
    {

 if ($this->quotation) {
            $total = $this->quotation->quotationitems()->sum('total');
   $gst= $this->quotation->quotationitems()->sum('item_gst');

             $this->quotation?->refreshTotal( $total,$gst);
        }



       /* if ($this->quotation) {
            $total = $this->quotation->quotationitems()->sum('total');
            $this->quotation->update(['total' => round($total, 2)]);
        }*/
    }

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
