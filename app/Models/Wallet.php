<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Wallet extends Model
{
	use HasFactory;
	protected $table = "wallets"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
        'amount',
        'status',
        
        
    ];
    
  public function userData()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
	
}