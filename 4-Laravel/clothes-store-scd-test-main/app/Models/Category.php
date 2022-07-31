<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [''];   
    protected $primaryKey = 'cat_id';

    public function products()
    {
        return $this->hasMany(Product::class,'product_category_id', 'cat_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class,'product_category_id', 'cat_id');
    }

}
