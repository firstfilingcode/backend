<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Clint extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "clints"; //table name
	
	protected $fillable = [
	    'id',
	    'name',
	   'photo',
        'status',
        
        
    ];
	
}