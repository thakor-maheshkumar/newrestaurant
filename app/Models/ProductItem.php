<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable=['product_items'];

    protected $table='product_items';

    public function products()
    {
        return $this->belongsTo('\App\Models\Product');
    }
}
