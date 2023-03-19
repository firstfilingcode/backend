<?php

namespace App\Http\Controllers\Api;   

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\Language;
use App\Models\NotificationUser;
use App\Models\DemonstrationVideos;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;

   
class ApiController extends BaseController
{

	public function language_list(Request $request){			

		 try {			
			$Language   = Language::where('status',1)->get();			
			$store = array();			
			foreach($Language as $data){			
			$store[] = array(
				'id'=>$data->id,
				'name'=>$data->name,
				'code'=>$data->code,
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

	 public function notification_list(Request $request){			
		 try {			

			$notifications   = NotificationUser::where('user_id',$request->user()->id)->get();			
			$store = array();			
			foreach($notifications as $data){			
			$store[] = array(
				'id'=>$data->id,
				'title'=>$data->title,
				'message'=>$data->message,
			);
			}
			return $this->sendResponseData($store, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}

	public function homepageDemoVideo(Request $request){
		try{

			$HomeDemoVideos = DemonstrationVideos::get();
			foreach($HomeDemoVideos as $HomeDemoVideo)
			{
				$homeVideo[] = array(
					'id' => $HomeDemoVideo->id,
					'type' => $HomeDemoVideo->type,
					'video' => url('public/uploads/demonstration_videos').'/'.$HomeDemoVideo->video,
				);
			}
			return $this->sendResponseData($homeVideo, 'success');
		}catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}

	}
}

