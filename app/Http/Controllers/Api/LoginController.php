<?php

namespace App\Http\Controllers\Api;   
use Illuminate\Http\Request;
use App\Models\WebUser;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet; 
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;
use App\Helpers\helpers;
use Mail;

   
class LoginController extends BaseController
{   

    	/** profile api  **/
    	
		public function profile(Request $request,$user_id){
		    	
			$request_data = $request->json()->all();
			
		    $data = $this->user_data($user_id);
		
		 return  response()->json(['status'=>true,'message'=>'User Profile','data'=>$data],200 );
		}
		
		
        	/** user_data  **/
		function user_data($id){
          
            $user_profile = User::select('users.*','document.aadhar_image','document.pan_image','document.aadhar_no','document.pan_no')
            ->leftjoin('user_documents as document','users.id','document.user_id')->where('users.id',$id)->first();
				$image_url1 ="";
				$image_url2 ="";
				$image_url3 ="";
			if($user_profile){
				if(!empty($user_profile->photo)){ 
					$image_url1 =  env('IMAGE_SHOW_PATH').'/profile/'.$user_profile->photo;				
					}else{
					$image_url1 = '';
				}
				if(!empty($user_profile->aadhar_image)){ 
					$image_url2 =  env('IMAGE_SHOW_PATH').'/user_documents/'.$user_profile->aadhar_image;				
					}else{
					$image_url2 = '';
				}
				if(!empty($user_profile->pan_image)){ 
					$image_url3 =  env('IMAGE_SHOW_PATH').'/user_documents/'.$user_profile->pan_image;				
					}else{
					$image_url3 = '';
				}
				
				$wallet = Wallet::where('user_id',$id)->first('amount');
				$amount = 0;
				if(!empty($wallet)){
				    $amount = $wallet->amount;
				}else{
				    $amount = 0;
				}
				$user_data =  array(			        
				'id'=> $user_profile->id,			
				'name'=> $user_profile->name,
				'first_name'=> $user_profile->first_name,
				'last_name'=> $user_profile->last_name,
				'email'=>$user_profile->email,
				'mobile'=> $user_profile->mobile,						
				'address'=> $user_profile->address,	
				'doc_status'=>$user_profile->doc_status,	 
				'aadhar_no'=>$user_profile->aadhar_no,	 
				'pan_no'=>$user_profile->pan_no,	 
				'photoURL'=> $image_url1,
				'aadhar_image'=> $image_url2,
				'pan_image'=> $image_url3,
				'wallet'=> $amount,
				);	

				return $user_data;
				}else{
				return '';	
			}
		}
		
		/** update api  **/
		public function update(Request $request){	
		    $request_data = $request->json()->all();
			try {
				$FetchData = WebUser::find($request_data['user_id']);
				// upload Photo
				$destinationPath = env('IMAGE_SHOW_PATH').'/profile/';			
				$name = '';
				if($request->hasFile('uploadFile')){
					if(!empty($FetchData->image) ){
						$file_path=  env('IMAGE_SHOW_PATH').'/profile/';
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
				$FetchData->update($request_data);		
				//$success =  $this->user_data($request_data['user_id']);				
				//return $this->sendResponseData($success, 'Receive success'); 
			    	return $this->sendResponse('', 'Update Date success');    
				} catch (Exception $e) {
				return $this->sendError('Validation Error.', 'Receive Error');            
			}
		}
		
			/** Login api  **/
		public function login(Request $request)   {
			$request_data = $request->json()->all();
		$validator = Validator::make($request->all(), [          
            'password' => 'required',            
			'email' => 'required',
			]
			);
			
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
				$user = User::where("email",$request->email)->first();
				
    			
    			   
    			if($user){
    			    if($user->auth_provider == 'firebase'){
    			        return $this->sendError('Login Error.', 'Please Login With Google');
    			    }
    			    else{
    			        if($user->status == 0){
    			    if(Hash::check($request->password,$user->password)){ 
    				$success = array_merge($this->user_data($user->id));
    			
    				return $this->sendResponseData($success, 'Success');               
    			    }else{
    				return $this->sendError('Validation Error.', 'Invalid Password');
    			    }
    			    }
    			    else{
    			 return $this->sendError('Validation Error.', 'Your account has been suspended by admin');
    			}
    			}
    			    
    			}else{
    				return $this->sendError('Validation Error.', 'No user Found');
    			}
    		
			}
			
			
		public function resetPass(Request $request)   {
			$data = $request->json()->all();
		$validator = Validator::make($request->all(), [          
          	
            'password' => 'required',            
			'email' => 'required',
			]
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
    		
    		$user  = User::where('email',$request->email);
            $pass=$user->update(['password'=>Hash::make($request->password),'show_password'=>$request->password]);
			$success = '';						
			return $this->sendResponseData($success, 'Success');
             
    			
			}
			
	
			
		public function forgetPass(Request $request)   {
			$forget = $request->json()->all();
		$validator = Validator::make($request->all(), [          
			'email' => 'required',
			]
			);
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			$user = User::where("email",$request->email)->first();
			
			
			if(empty($user->auth_provider)){
			    if($user){
                    $otp = mt_rand(1000, 9999);
                    
                    $emailData = ['email'=>$request->email, 'subject' => 'Forgot Password OTP','otp'=>$otp]; 
                    $data = sendMail('admin.emails.forgot',$emailData);
                    
                    return  response()->json(['status'=>true,'message'=>'forget password otp','otp'=>$otp],200 );
                    
                    }else{
    				return $this->sendError('Validation Error.', 'No Found user Error');
    			}
			    
			}else{
			    return $this->sendError('Validation Error.', 'Please Login With Google');
			}
			
			
    				
    	}
/** SignUp api  **/
		public function signUp(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'mobile' => 'required',
			'password' => 'required',
			]
			);
			
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
		    
			$input = $request->all();
            $user = User::create($input);
            $pass=$user->where('id',$user->id)->update(['password'=>Hash::make($request->password),'userName'=>$request->email,'name'=>$request->first_name.' '.$request->last_name,'role_id'=>5,'show_password'=>$request->password]);
             $userDocument = new UserDocument;
                     $userDocument->user_id = $user->id;
        		     $userDocument->save();
           $emailData = ['email'=>$request->email, 'subject' => 'Sign Up Successfully']; 
           $data = sendMail('admin.emails.sign_up',$emailData);
            
         
            $data = $this->user_data($user->id);
              if(!empty($data)){
    				  return  response()->json(['success'=>true,'message'=>'Sign Up Completed','data'=>$data],200 );
              }
              
              else{
                  return  response()->json(['success'=>true,'message'=>'Email already exist','data'=>$data],200 );
              }
    			
			}
			
			
			
		public function googleLogin(Request $request)   {
		$validator = Validator::make($request->all(), [          
		        'email'=> 'required',
		        'name'=> 'required',
		        'auth_provider'=> 'required'
			]
			);
			
			
			if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			
			
			$data = User::where('email',$request->email)->where('auth_provider',$request->auth_provider)->get();
		
	
			
            	if(count($data)>0){            
            	    	$data1 = User::where('email',$request->email)->first();
			 return  response()->json(['status'=>true,'message'=>'Logged in Successfully','data'=>$data1],200 );
			    }else{
    			         $user = new User;
                         $user->name = $request->name;
                         $user->email = $request->email;
                         $user->auth_provider = $request->auth_provider;
                         $user->role_id = 5;
            		     $user->save();
        		      
        		     
				
			             $userDocument = new UserDocument;
                         $userDocument->user_id = $user->id;
            		     $userDocument->save();
            		         $emailData = ['email'=>$request->email, 'subject' => 'Sign Up Successfully']; 
                                $data = sendMail('admin.emails.sign_up',$emailData);
            		     
        		     	$data1 = User::where('id',$user->id)->first();
        		     return  response()->json(['status'=>false,'message'=>'Logged in Successfully','data'=>$data1],200 );
			    }
		    
			}
			
			
			
		
}

