<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "routes"; //table name
	
	protected $fillable = [
	    'id',
        'page_name',
        'route',
        'service_sub_type_id',
        'service_type_id',
        'order_By',
        
    ];
	
}