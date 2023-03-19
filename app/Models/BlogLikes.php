<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BlogLikes extends Model
{
	use HasFactory;
	protected $table = "blog_likes"; //table name
	
	protected $fillable = [
	    'id',
        'user_id',
        'blog_id',
        'likes',
        'share',
          ];
	
}