<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ServiceTypesDropdown extends Model
{
	use HasFactory;
	protected $table = "service_types_dropdown"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'service_type_id',
        'status',
      
    ];
	
}