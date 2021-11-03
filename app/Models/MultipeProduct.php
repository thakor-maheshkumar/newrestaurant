<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipeProduct extends Model
{
    use HasFactory;

   protected $table = 'multipe_products';
    protected $guarded = ['multipe_products'];


    public function product()
    {
        return $this->belongsTo('\App\Models\Product','product_name','id');
    }
}
