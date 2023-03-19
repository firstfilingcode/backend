<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WalletDetail extends Model
{
	use HasFactory;
	protected $table = "wallet_details"; //table name
	
	protected $fillable = [
	    'id',
	    'name',
	    'wallet_id',
	    'user_id',
	    'transaction_no',
	    'amount',
	    'status',
	    
        
        
    ];
    
  public function userData()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
	
}