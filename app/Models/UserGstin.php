<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserGstin extends Model
{ 
	use HasFactory;
	protected $table = "user_gstin_details"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
	    'firm_name',
	    'gstin',
	    'firm_address',
	    'pin_code',
    ];
    
  
}