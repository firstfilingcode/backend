<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Coupon extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = "coupons"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
        'name',
        'status',
        'up_to_discount',
        'from_date',
        'discount_percent',
        'service_id',
        'to_date',
        'coupon_code',
        
    ];
	
}