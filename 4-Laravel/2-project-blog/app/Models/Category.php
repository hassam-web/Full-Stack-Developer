<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [''];
    protected $primaryKey = 'cat_id';

    public function posts()
    {
        return $this->hasMany(Post::class,'post_category_id', 'cat_id');
    }
}