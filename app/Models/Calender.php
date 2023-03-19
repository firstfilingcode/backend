<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Calender extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "calender"; //table name
	
	protected $fillable = [
	    'id',
	    'name',
        'type',
        'date',
        'color_code',
        'status',
       
       
    ];
	
}