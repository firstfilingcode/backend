<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Detail extends Model
{
	use HasFactory;
	protected $table = "details"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'email',
        'mobile',
        'query',
        'page_name',
       
    ];
	
}