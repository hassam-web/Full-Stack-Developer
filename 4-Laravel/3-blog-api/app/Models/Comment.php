<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'comment_user_id','user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'comment_post_id','id');
    }
}