<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Branch extends Model
{
	use HasFactory;
	protected $table = "branchs"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
        'name',
        'owner_name',
        'branch_code',
        'gst_no',
        'mobile_no',
        'email',
        'contrary_id',
        'state_id',
        'city_id',
        'address',
        'pin_code',
        'status',
        
        
    ];
	
}