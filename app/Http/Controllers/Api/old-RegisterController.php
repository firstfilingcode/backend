<?php	
	namespace App\Http\Controllers\Api;   
	use Illuminate\Http\Request;
	use App\Http\Controllers\Api\BaseController as BaseController;
	use App\Models\Customer;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use Hash;
	use File;
	use URL;
	use Image;	
	class RegisterController extends BaseController
	{
		
		
		
		public function register(Request $request)
		{
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
			
			$success = array(			
			'phone'=>$request->phone,
			'otp'=>'0000'
			);;				
			return $this->sendResponseData($success, 'Sent otp');             
		}
		
		
		/** Register api  **/
		public function mobile_verified(Request $request)
		{
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
		
		/** Login api  **/
		public function login(Request $request)   {
			$validator = Validator::make($request->all(), [         
            'mobile' => 'required',            
            'device_token' => 'required',
			]		
			);
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
			$user = Customer::where("mobile",$request->mobile)->first();
			if($user){          
				Customer::where('id', $user->id)->update(['device_token' => $request->device_token]); 
				$success = array_merge($this->user_data($user->id), array("token"=>$user->createToken('MyApp')->accessToken));						
				return $this->sendResponseData($success, 'Success');               
				
				}else{
				return $this->sendError('Validation Error.', 'No Found user Error');
			}
			
			
		}
		
		function user_data($id){
			$user_profile = Customer::where('id',$id)->first();	
			if($user_profile){
				if(!empty($user_profile->image) && File::exists( public_path().'/uploads/profile/'.$user_profile->image)){ 
					$destinationPath = URL::to('/').'/public/uploads/profile/'.$user_profile->image;				
					}else{
					$destinationPath = '';
				}
				
				$user_data = (object) array(			        
				'id'=> $user_profile->id,			
				'is_mobile_verified'=> $user_profile->is_mobile_verified,						
				'name'=> !empty($user_profile->name) ? $user_profile->name : '',
				'email'=> !empty($user_profile->email) ? $user_profile->email : '',
				'mobile'=> !empty($user_profile->mobile) ? $user_profile->mobile : '',						
				'image'=> $destinationPath,
				);		
				return $user_data;
				}else{
				return '';	
			}
		}
		
		public function update(Request $request){			
			try {
				$FetchData = Customer::find($request->user()->id);
				// upload Photo
				$destinationPath = public_path().'/uploads/profile';			
				$name = '';
				if($request->hasFile('uploadFile')){
					if(!empty($FetchData->image) && File::exists( public_path().'/uploads/profile/'.$FetchData->image)){
						$file_path=  public_path('/uploads/profile/'.$FetchData->image);
						unlink($file_path);
					}
					$image = $request->file('uploadFile');				
					$name=$image->getClientOriginalName();
					$extension = $image->getClientOriginalExtension();  //Get Image Extension
					$name = round(microtime(true) * 1000).'.'.$extension;									
					$image->move($destinationPath, $name);
					
					}else{
					$name = $FetchData->image;
				}
				// end photo		
				$request->merge(["image"=>$name]);		
				$FetchData->update($request->all());		
				$success =  $this->user_data( $request->user()->id);				
				return $this->sendResponseData($success, 'Receive success');         
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Receive Error');            
			}
		}
		
		
		
		public function profile(Request $request){			
			try {
				$success =  $this->user_data( $request->user()->id);				
				return $this->sendResponseData($success, 'Receive success');         
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Receive Error');            
			}
		}
		
		public function logout(Request $request){	
			try {
				Customer::where('id', $request->user()->id)->update(['device_token' => '']);          
				return $this->sendResponse('', 'Logout success');          
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Logout Error');            
			} 
		}
		
		
			
		/** Login sociallite apple,facebook,google api  **/
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
		
		
		
		public function resend_otp(Request $request){			
			try {
				$validator = Validator::make($request->all(), [          				
				'mobile' => ['required', 'numeric']
				]);
				
				if($validator->fails()){            
					return $this->sendError('Validation Error.', $validator->messages()->first());
				}
				
				//$user = Customers::where('phone',$request->phone)->first();
				//if($user){
				$success = array(						
				'phone'=>$request->phone,
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
		
		
		public function forgot(Request $request)   {
			$validator = Validator::make($request->all(), [         
			'mobile' => 'required|numeric'           
			],
			[          
			'mobile.numeric' => 'Enter mobile number' , 
			'phone.required' => 'Enter mobile number' ,   
			
			
			]
			);
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
			$user = Customer::where("mobile",$request->mobile)->first();
			if($user){          	
				$success = array(
				'customer_id'=>$user->id,
				'mobile_number'=>$request->mobile,
				'otp'=>'0000'
				);
				return $this->sendResponseData($success, 'Sent OTP on your mobile.');                
				}else{
				
				return $this->sendError('Validation Error.','this number is wrong');
			}
			
			
			
		}
		
		
		/** New Password Reset api  **/
		public function reset_password(Request $request){
			$validator = Validator::make($request->all(), [
			'customer_id' => 'required|exists:customers,id',
			'password' =>'required|min:6',
			]
			
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}		
			$FetchData = Customer::find($request->customer_id);	
			$input = $request->all();		
			$input['password'] = bcrypt($input['password']);
			$FetchData->update($input);
			return $this->sendResponse('', 'Password update successfully!');             
		} 
		
		
		public function change_password(Request $request){
			
			$validator = Validator::make($request->all(), [          
			'password' =>'required|min:6',
			'confirm_password' =>'required|same:password',            
			
			
			
			
			],
			[          
			'password.required' => trans('api.register.validation.password.required'),
			'password.min' => trans('api.register.validation.password.min'),
			'confirm_password.required' => trans('api.register.validation.confirm_password.required'),           
			'confirm_password.same' => trans('api.register.validation.confirm_password.same'),            
			
			
			]
			);
			
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			$user = Customer::where("id",$request->user()->id)->first();		
			$FetchData = Customer::find($user->id);	
			$input = $request->all();		
			$input['password'] = bcrypt($input['password']);
			$FetchData->update($input);
			
			return $this->sendResponse('', 'Success');             
		} 
		
		
	}	