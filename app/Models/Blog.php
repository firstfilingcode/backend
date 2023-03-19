<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "blogs"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'status',
        'photo',
        'remark',
        'category',
        'ck_editor',
        'author',
        'backlings',
        
        
    ];
	
}