<?php
   
namespace App\Http\Controllers\Api;   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Customer;
use App\Models\Map;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;
   
class MapController extends BaseController
{
	
    
	   public function map_list(Request $request){			
		 try {			
			$map   = Map::all();			
			$store = array();			
			foreach($map as $data){			
			$store[] = array(
				'id'=>$data->id,
				'name'=>$data->name,				
				'image'=>URL::asset('public/uploads/maps/'.$data->photo),
				'gpx'=>URL::asset('public/uploads/maps/'.$data->map_json),
				'is purchased'=>true,
				'amount'=>$data->amount,
				'created_at'=>date('Y-m-d H:i:s',strtotime($data->created_at)),
				'updated_at'=>date('Y-m-d H:i:s',strtotime($data->updated_at)),
				
			);
			}
			return $this->sendResponseData($store, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}
	
	public function map_update_status(Request $request){			
		 try {			
			$id   = $request->map_id;

			$map = Map::where('id',$id)->select('updated_at')->first();			
			if($map){
				return $this->sendResponseData(date('Y-m-d H:i:s',strtotime($map->updated_at)), 'success');         
			}else{
				return $this->sendError('Validation Error.', 'MAP ID INVALID');            
			}
			
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}
	
	public function package_list(Request $request){			
		 try {			
			 $map   = Package::all();			
			$store = array();			
			foreach($map as $data){			
			$store[] = array(
				'id'=>$data->id,
				'name'=>$data->name,				
				'image'=>URL::asset('public/uploads/packages/'.$data->photo),				
				'is purchased'=>true,
				'amount'=>$data->amount,
				'map_quantity'=>$data->map_quantity,
			);
			}
			return $this->sendResponseData($store, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}
	
		public function coupon_list(Request $request){			
		 try {			
			$map = Coupon::where('start_date', '<=', Carbon::now())
			->where('end_date', '>=', Carbon::now())
			->get();
			$store = array();			
			foreach($map as $data){			
			$store[] = array(
				'id'=>$data->id,
				'discount'=>$data->discount
			);
			}
			return $this->sendResponseData($store, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}
	
	public function setting(Request $request){			
		 try {			
			$setting = Setting::first();			
			$data = array(
				'logo'=>URL::asset('public/uploads/logo/'.$setting->logo),
				'email'=>$setting->email,
				'phone'=>$setting->phone,
				'about_us'=>$setting->about_us,
			);
			
			return $this->sendResponseData($data, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}
	
}
