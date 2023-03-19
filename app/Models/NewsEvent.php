<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NewsEvent extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "news_events"; //table name
	
	protected $fillable = [
	    'id',
	    'role_id',
	    'date',
	    'time',
	    'title',
        'status',
        'event_description',
        
        
    ];
	
}