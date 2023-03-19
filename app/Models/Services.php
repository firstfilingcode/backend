<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Services extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "services"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'ca_share',
        'slug',
        'page_name',
        'status',
        'service_type_id',
        'status_id',
        
    ];
	
}