<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];
   

    public function productName()
    {
        return $this->belongsTo(ProductName::class, 'product_id', 'id');
    }
}

