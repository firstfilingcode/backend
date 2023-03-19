<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
	use HasFactory;
	protected $table = "order_details"; //table name
	
	protected $fillable = [
	    'id',
	    'user_id',
	    'name',
	    'mobile',
        'amount',
        'status',
        'service_detail_id',
        
        
    ];
    
  public function userData(){
      return $this->belongsTo('App\Models\Order','user_id');
    }
    public function serviceDetails(){
      return $this->belongsTo('App\Models\ServiceDetail','service_detail_id');
    }
	
	public static function countPandingOrder(){
        $data = Order::all();
    
            $panding = $data->count();
       
            return $panding;
			
		}
	
}