<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WalletSetting extends Model
{
	use HasFactory;
	protected $table = "wallet_settings"; //table name
	
	protected $fillable = [
	    'id',
	    'refer_form_amount',
	    'refer_to_amount',
	   'amount_range_from',
	    'amount_range_to',
	    'status',
	    
        
        
    ];
    
  
}