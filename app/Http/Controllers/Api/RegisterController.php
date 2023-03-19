<?php	
	namespace App\Http\Controllers\Api;   
	use Illuminate\Http\Request;
	use App\Http\Controllers\Api\BaseController as BaseController;
	use App\Models\Customer;
	use App\Models\User;
	use App\Models\Slider;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use Hash;
	use File;
	use URL;
	use Image;	
	class RegisterController extends BaseController	{		
		
		
		/** contactUs api  **/
// 		public function contactUs(Request $request)   {
// 		$validator = Validator::make($request->all(), [          
//             'name' => 'required',            
// 			'mobile' => 'required',
// 			'email' => 'required',
// 			'comment' => 'required',
// 			]
// 			);
			
// 			if($validator->fails()){            
// 				return $this->sendError('Validation Error.', $validator->messages()->first());
// 			}
// 			$input = $request->all();
//             $blog = Contacts::create($input);
//     				$success = '';						
//     				return $this->sendResponseData($success, 'Success');               
    			
// 			}
		
		
		/** Slider api  **/
		public function getSlider(Request $request){
		try{
			$slider =  Slider::orderBy('id','DESC')->get();
			$list = array();
			foreach ($slider as $img) {
					$list[] = array(
					'id' => $img->id,
					'name' => $img->name,
					'photo' => env('IMAGE_SHOW_PATH').'slider/'.$img->photo,
					);
			}

			if(count($list) > 0){
				return $this->sendResponseData($list, 'success');
			}
			else{
				$list = '';
				return $this->sendResponseData($list, 'No Record Found');
			}

		}catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	
	}
				/** register api  **/
		public function register(Request $request){
			$validator = Validator::make($request->all(), [          
            'email' => 'required|email|unique:users',
            'name' => 'required',            
			'mobile' => 'required|numeric|unique:users',
			]
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
		$input = $request->all();
            $user = User::create($input);
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');              
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

				
		/** mobile_verified api  **/
		public function mobile_verified(Request $request){
			$validator = Validator::make($request->all(), [          
          	'device_token' => 'required',
            'email' => 'required|email|unique:customers',
            'name' => 'required',            
			'mobile' => 'required|numeric|unique:customers',
			]
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
			$input = $request->all();
			$input['is_mobile_verified'] = 1;
			$user = Customer::create($input);
			
			$success = array_merge($this->user_data($user->id), array("token"=>$user->createToken('MyApp')->accessToken));			
			return $this->sendResponseData($success, 'Customer Register success');             
		}
		
		/** login otp api  **/
		public function login_otp(Request $request){
			$validator = Validator::make($request->all(), [          
          	'mobile' => 'required',
			]
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
			$user = Customers::where('mobile',$request->mobile)->first();
				if($user){
				$success = array(						
				'mobile'=>$request->mobile,
				'otp'=>'0000'
				);
				return $this->sendResponseData($success, 'OTP sent!');             
				 }else{
					return $this->sendError('Validation Error.', 'Receive Error');            
				} 
			
		}
		
	
		
		/** logout api  **/
		public function logout(Request $request){	
			try {
				Customer::where('id', $request->user()->id)->update(['device_token' => '']);          
				return $this->sendResponse('', 'Logout success');          
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Logout Error');            
			} 
		}
		
		/** Login social_login apple,facebook,google api  **/
		public function social_login(Request $request){				
			$validator = Validator::make($request->all(), [					
			'social_id' => 'required',						
			'login_by' => 'required|in:facebook,google,Apple',
			],
			[			
			'social_id.required' => 'Empty social ID',			
			'login_by.required' => 'Empty login type',			
			]
			);
			if ($validator->fails()) {			
				return $this->sendError('Validation Error.', $validator->messages()->first());	   
				}else{
				
				if($request->login_by=='facebook'){				
				$field = 'fb_social_id';
				}else if($request->login_by=='google'){
				$field = 'google_social_id';				
				}else if($request->login_by=='apple'){ 
				$field = 'apple_social_id';				
				}
				
				$user = Customer::where($field,$request->social_id)->where('login_by',$request->login_by)->select('id')->first();
				if($user){		
					Customer::where('id', $user->id)->update(['device_token' => $request->device_token, 'device_type'=> $request->device_type]);	
					$success = array_merge($this->user_data($user->id), array("token"=>$user->createToken('MyApp')->accessToken));				
					return $this->sendResponseData($success, 'Login success');  
					}else{			
					//register
					$input = $request->all();
					
					if($request->login_by=='facebook'){				
					$input['fb_social_id'] = $request->social_id;
					}else if($request->login_by=='google'){				
					$input['google_social_id'] = $request->social_id;
					}else if($request->login_by=='apple'){ 
					$input['apple_social_id'] = $request->social_id;

					}
				
					if(!empty($request->avatar)){
						$url = $request->avatar;		
						$imgname = time().'.jpg';
						$img = public_path('uploads/profile/'.$imgname);
						file_put_contents($img, file_get_contents($url));
						$input['image'] = $imgname;
					}
				//	$input['device_type'] = 'app';						
					$user = Customer::create($input);
					$success = array_merge($this->user_data($user->id), array("token"=>$user->createToken('MyApp')->accessToken));			
					return $this->sendResponseData($success,'Login success');     
				}
			}			
			
		}
		
		/** resend_otp api  **/
		public function resend_otp(Request $request){			
			try {
				$validator = Validator::make($request->all(), [          				
				'mobile' => ['required', 'numeric']
				]);
				
				if($validator->fails()){            
					return $this->sendError('Validation Error.', $validator->messages()->first());
				}
				
				//$user = Customers::where('mobile',$request->mobile)->first();
				//if($user){
				$success = array(						
				'mobile'=>$request->mobile,
				'otp'=>'0000'
				);
				return $this->sendResponseData($success, 'OTP sent!');             
				/* }else{
					return $this->sendError('Validation Error.', 'Receive Error');            
				} */
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Receive Error');            
			}
		}

}	