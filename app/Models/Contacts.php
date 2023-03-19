<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Contacts extends Model
{
	use HasFactory;
	protected $table = "contacts"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'mobile',
        'email',
        'query',
        'page_name',
        'status',
        'user_id',
        
    ];
	
}