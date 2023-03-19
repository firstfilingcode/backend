<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceSubType extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "service_sub_types"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'service_type_id',
        'service_type_dropdown_id',
        'status',

    ];
	
}