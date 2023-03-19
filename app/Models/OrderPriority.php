<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderPriority extends Model
{
	use HasFactory;
	protected $table = "order_prioritys"; //table name
	
	protected $fillable = [
	    'id',
        'user_id',
        'name',
        'color_code',
        'status'
        
        
    ];
	
}