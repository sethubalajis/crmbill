<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Gst extends Model
{
    protected $table = 'gsts';

		protected $fillable = [
        'percentage',
    ];
    
	
}