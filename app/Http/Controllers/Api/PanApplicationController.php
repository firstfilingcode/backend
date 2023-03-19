<?php
namespace App\Http\Controllers\Api; 

use App\Helpers\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

use App\Models\PanApplication;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;
use Response;

   
class PanApplicationController extends BaseController
{

	public function panAppSubmit(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'email' => 'required|email|unique:news_leters,email',
			]
			);
			
			if($validator->fails()){            
    				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
    			
            $input = $request->all();
            $panApp = PanApplication::create($input);
               
            // $emailData = ['email'=>$request->email, 'subject' => 'Subcribed Successfully']; 
            // $data = sendMail('admin.emails.news_letter',$emailData);
            
    				$success = '';	
    			
    				return $this->sendResponseData($success, 'Success');   
			
		       if(!empty($panApp)){
    				  return  response()->json(['success'=>true,'message'=>'Pan request submitted successfully'],200 );
              }
              
              else{
                  return  response()->json(['success'=>true,'message'=>'Something went wrong'],200 );
              }
    			
			}
			


	}
