<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderDetail extends Model
{
	use HasFactory;
	protected $table = "order_details"; //table name
	
	protected $fillable = [
	    'id',
	    'name',
	    'wallet_id',
	    'user_id',
	    'transaction_no',
	    'coupon_code',
	    'coupon_id',
	    'coupon_discount',
	    'amount',
	    'status',
	    'service_detail_id',
	    'service_id',
	    'total_amount',
	    'reimbursement_amt'
	    
        
        
    ];
    
  public function userData()
    {
        return $this->belongsTo('App\Models\User','user_id_to');
    }
	
}