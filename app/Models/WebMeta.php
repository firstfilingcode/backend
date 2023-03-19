<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WebMeta extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "web_meta"; //table name
	
	protected $fillable = [
	    'id',
        'page_name',
        'status',
        'photo',
        'tittle',
        'meta_kyewords',
        'meta_description',
    ];
	
}