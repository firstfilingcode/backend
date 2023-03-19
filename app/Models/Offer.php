<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Offer extends Model
{
	use HasFactory;
	protected $table = "offers"; //table name
	
	protected $fillable = [
	    'id',
        'name',
        'status',
        'photo',
        'from_date',
        'to_date',
        'promo_code',
        
    ];
	
}