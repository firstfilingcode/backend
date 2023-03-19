<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BlogCommentReply extends Model
{
	use HasFactory;
	protected $table = "blog_comment_reply"; //table name
	
	protected $fillable = [
	    'id',
        'blog_comment_id',
        'user_id',
        'status',
        'reply',
        
        
        
    ];
	
}