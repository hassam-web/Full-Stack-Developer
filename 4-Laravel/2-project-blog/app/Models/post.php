<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $guarded = [''];
    protected $primaryKey = 'post_id';
    // protected $append = ['new_date'];


    /*public function getPostDateAttribute($value)
    {
        return date("M d, Y h:i A",strtotime($value));
    }*/

    public function category()
    {
        return $this->belongsTo(Category::class,'post_category_id', 'cat_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'comment_post_id', 'post_id');
    }

    // public function setSlugAttribute(){
    //     $this->attributes['slug'] = Str::slug($this->post_title , "-");
    // }

   public function getRouteKeyName()
   {
        return 'slug';
   }
}

