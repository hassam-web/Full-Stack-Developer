<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $guarded = [''];
    // protected $primaryKey = 'product_category_id'; 

    public function cart_category()
    {
        return $this->belongsTo(Category::class,'product_category_id', 'cat_id');
    }
}
