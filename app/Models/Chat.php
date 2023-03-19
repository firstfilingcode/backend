<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Chat extends Model
{
	use HasFactory;
	protected $table = "chats"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
        'message',
        'role_id',
        'order_id',
        'rm_user_id',
        'ca_user_id',
       
    ];
	
}