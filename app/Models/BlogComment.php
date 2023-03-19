<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BlogComment extends Model
{
	use HasFactory;
	protected $table = "blog_comments"; //table name
	
	protected $fillable = [
	    'id',
        'blog_id',
        'user_id',
        'comments',
        
        
        
    ];
	
}