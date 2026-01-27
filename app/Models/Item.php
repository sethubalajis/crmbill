<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'rate',
        'hsn',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->code)) {
                $lastItem = static::withTrashed()->orderBy('id', 'desc')->first();
                $nextId = $lastItem ? $lastItem->id + 1 : 1;
                $item->code = 'ITM' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
