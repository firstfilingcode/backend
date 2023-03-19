<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Status extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "status"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'status',
        'order_by',
        'status_massage'
    ];
	
}