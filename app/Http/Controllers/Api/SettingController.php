<?php
namespace App\Http\Controllers\Api; 

use App\Helpers\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Setting;
use App\Models\Blog;
use App\Models\Clint;
use App\Models\About;
use App\Models\WebMeta;
use App\Models\Faq;
use App\Models\City; 
use App\Models\Wallet; 
use App\Models\WalletDetail; 
use App\Models\WalletSetting; 
use App\Models\Chat;
use App\Models\Calender;
use App\Models\NewsLetter;
use App\Models\BlogComment;
use App\Models\BlogLikes;
use App\Models\BlogCommentReply;
use App\Models\Services;
use App\Models\ServicesType;
use App\Models\ServiceSubType;
use App\Models\ServiceDetail;
use App\Models\UserDocument;
use App\Models\ServiceDocuments;
use App\Models\ServiceTypesDropdown;
use App\Models\User;
use App\Models\Route;
use App\Models\Docs;
use App\Models\DocType;
use App\Models\Coupon;
use App\Models\OrderRequiredDocuments;
use App\Models\NewsEvent;
use App\Models\UserGstin;
use App\Models\State;
/*use App\Models\Route;*/
use App\Models\Contacts;
use App\Models\Notification;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;
use Response;

   
class SettingController extends BaseController
{
	public function setting(Request $request){			

		 try {			
			$setting = Setting::first();			
			$data = array(
				'logo'=>URL::asset('public/uploads/logo/'.$setting->logo),
				'name'=>$setting->name,
				'email'=>$setting->email,
				'phone'=>$setting->phone,
				'facebook_link'=>$setting->facebook_link,
				'youtube_link'=>$setting->youtube_link,
				'twitter_link'=>$setting->twitter_link,
				'instagram_link'=>$setting->instagram_link,
				'watsapp_link'=>$setting->watsapp_link,
				'linkedin_link'=>$setting->linkedin_link,
				'tin_no'=>$setting->tin_no,
				'address'=>$setting->address,
				'pincode'=>$setting->pincode,
			);
			return $this->sendResponseData($data, 'success');         
		} catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}
	}

    public function about(Request $request ){			

		 try {			
			$about = About::get()->first();
		$data = array(
				'photo'=>env('IMAGE_SHOW_PATH').'about/'.$about->photo,
				'name'=>$about->name,
				'short_description'=>$about->short_description,
				'long_description'=>$about->long_description,

			);  
            return  response()->json(['status'=>true,'message'=>'success','data'=>$data ],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function privacy_policy(Request $request){			
		 try {			
			$setting = Setting::get()->first();
			$data =$setting->privacy_policy;
	       
            return  response()->json(['status'=>true,'data'=>$data ,'message'=>"Privacy Policy Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function terms_conditions(Request $request){			
	try {			
			$setting = Setting::get()->first();
			$data =$setting->terms_and_conditions;
	          
            return  response()->json(['status'=>true,'data'=>$data ,'message'=>"Terms And Conditions Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	public function contact_us(Request $request){			
        try {			
			$setting = Setting::get()->first();
			$data =$setting->contact_us;
	         
            return  response()->json(['status'=>true,'data'=>$data ,'message'=>"Contact Us Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function service(Request $request){			
        try {			
			$setting = Setting::get()->first();
			$data =$setting->service;
	         
            return  response()->json(['status'=>true,'data'=>$data ,'message'=>"Service Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
    public function contactUs(Request $request){			
            $validator = Validator::make($request->all(), [          
    			
    			]
    			);
    			try {		
                $contactus =  new Contacts;
                $contactus->email = $request->email;
                $contactus->page_name = "Contact";
                $contactus->user_id = $request->user_id;
                $contactus->name = $request->name;
                $contactus->query = $request->message;
                $contactus->mobile = $request->mobile;
                $contactus->save();
        				$success = '';						
        				return $this->sendResponseData($success, 'Success');   
    			
    		if($validator->fails()){            
    				return $this->sendError('Validation Error.', $validator->messages()->first());
    			}
                
    		} 
    		
    		catch (Exception $e) {
    			return $this->sendError('message', 'Somthing Went Wrong');            
    		}
    		
    
        }
	
	public function chat(Request $request,$order_id){	
	  
        try {			
				$chat = Chat::select('chats.*','user.name as user_name','user.role_id')
            ->leftjoin('users as user','user.id','chats.user_id')->where('chats.order_id',$order_id)->get();
             $chatCount =0;
			$data = array();
			foreach ($chat as $item) {
					$data[] = array(
					'id' => $item->id,
			       	'user_id' => $item->user_id,
					'rm_user_id' => $item->rm_user_id,
					'ca_user_id' => $item->ca_user_id,
					'order_id' => $item->order_id,
					'role_id' => $item->role_id,
					'message' => $item->message,
					'name'=>$item->user_name,
					'created_at'=>$item->created_at,
					
					);
					$chatCount++;
			}
	         
            return  response()->json(['status'=>true,'message'=>'Chat Data','data'=>$data,'chatCount'=>$chatCount],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function blog(Request $request,$takes ){			

		 try {		
		     $blog =  Blog::where('status',1)->orderBy('id','DESC')->take($takes)->get();
		  //   $category_blog =  Blog::where('status',1)->orderBy('id','DESC')->take(4)->get();
		  //   $recents =  Blog::where('status',1)->orderBy('id','DESC')->take(3)->get();
			
				$list = array();
			foreach ($blog as $data) {
			    $blog_likes=BlogLikes::where('blog_id',$data->id)->where('likes',1)->count();
			    $blog_share=BlogLikes::where('blog_id',$data->id)->sum('share');
			    
					$list[] = array(
					'id' => $data->id,
					'name' => $data->name,
					'status' => $data->status,
					'author' => $data->author,
					'remark' => $data->remark,
					'created_at' =>date('M-d,Y', strtotime($data['created_at'])),
					'ck_editor' => $data->ck_editor,
					'backlings' => $data->backlings,
					'likes' => $blog_likes,
					'share' => $blog_share,
					'photo' => env('IMAGE_SHOW_PATH').'blog/'.$data->photo,
					);
			}
// 			$category =array();
// 				foreach ($category_blog as $data) {
// 					$category[] = array(
// 					'category' => $data->category
// 					);
// 			}
			
// 			$recent  = array();
// 				foreach ($recents  as $recent_data) {
// 					$recent[] = array(
// 					'id' => $recent_data->id,
// 					'name' => $recent_data->name,
// 					'author' => $recent_data->author,
// 					'ck_editor' => $recent_data->ck_editor,
// 					'created_at' =>date('M-Y', strtotime($recent_data['created_at'])),
// 					'remark' => $recent_data->remark,
// 					'photo' => env('IMAGE_SHOW_PATH').'blog/'.$recent_data->photo,
// 					);
// 			}
			
			if(count($list) > 0){
				 return  response()->json(['status'=>true,'message'=>'Blog Data','data'=>$list ],200 );
			}
			else{
				$list = '';
				return $this->sendResponseData($list, 'No Record Found');
			}
			
            // return  response()->json(['status'=>true,'data'=>$blog ,'message'=>"About Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function blogDetail(Request $request,$id,$user_id){			

		 try {		
		    $blog_detail =  Blog::where('id',$id)->get();
		     	$blog_likes=BlogLikes::where('blog_id',$id)->where('likes',1)->count();
		     	$blog_share=BlogLikes::where('blog_id',$id)->sum("share");
		     	$user_blog_likes=BlogLikes::where('user_id',$request->user_id)->where('blog_id',$id)->first('likes');
		     	if(!empty($user_blog_likes)){}
		     	else{
		     	    $user_blog_likes =0;
		     	}
		     	$blog_ids=Blog::get('id');
		     	$all_blog_ids =[];
		     	if(count($blog_ids)>0)
		     	{
		     	    foreach ($blog_ids as $item) {
			    	  
			    	  $all_blog_ids[] = $item->id;
			    	}
		     	}
		     	
		     
		     	 	
            
		   $comments =  BlogComment::where('blog_id',$id)->where('status',1)->orderBy('id','DESC')->get(); 
            
            
            $comment_list = array();
         
			foreach ($comments as $key=>$data) {
			       $reply_list = [];
			        $commentor_name =  User::where('id',$data->user_id)->first("name"); 
			       $reply =  BlogCommentReply::where('user_id',$data->user_id)->where('blog_comment_id',$data->id)->orderBy('id','DESC')->get(); 
			     
			    	foreach ($reply as $key=>$data1) {
			    	    $replier_name =  User::where('id',$data1->reply_user_id)->first("name"); 
			    	  
			    	   $reply_list[] = 
			    	   array(
					'reply' => $data1->reply,
					'replier' => $replier_name->name,
					'created_at' =>date('M-d,Y', strtotime($data1->created_at)), 
				
				
					);
			    	  
			    	}
					$comment_list[] = array(
					'id' => $data->id,
					'user_id' => $data->user_id,
					'commentor_name' => $commentor_name->name,
					'blog_id' => $data->blog_id,
					'comments' => $data->comments,
					'created_at' => date('M-d,Y', strtotime($data->created_at)), 
					'reply' => $reply_list,
					
				
				
					);
			}
		    
				$list = array();
			foreach ($blog_detail as $key=>$data) {
			    
					$list[] = array(
					'id' => $data->id,
					'name' => $data->name,
					'status' => $data->status,
					'author' => $data->author,
					'remark' => $data->remark,
					'created_at' =>date('M-d,Y', strtotime($data['created_at'])),
					'ck_editor' => $data->ck_editor,
					'backlings' => $data->backlings,
					'likes' => $data->likes,
					'photo' => env('IMAGE_SHOW_PATH').'blog/'.$data->photo,
					);
			}
			
			
			
			if(count($list) > 0){
				 return  response()->json(['status'=>true,'message'=>'Blog Data','data'=>$list,'data_comment'=>$comment_list ,'blog_likes'=>$blog_likes,'user_blog_like'=>$user_blog_likes,'blog_share'=>$blog_share,'all_blog_ids'=>$all_blog_ids],200 );
			}
			else{
			 return  response()->json(['status'=>false,'message'=>'Blog Data','data'=>$list ,'blog_likes'=>$blog_likes,'user_blog_like'=>$user_blog_likes,'blog_share'=>$blog_share,'all_blog_ids'=>$all_blog_ids],200 );
			}
			
            // return  response()->json(['status'=>true,'data'=>$blog ,'message'=>"About Data"],200);       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function our_clints(Request $request ){			

		 try {		
		     $clint =  Clint::where('status',1)->orderBy('id','DESC')->get();

				$list = array();
			foreach ($clint as $data) {
					$list[] = array(
					'id' => $data->id,
					'name' => $data->name,
					'photo' => env('IMAGE_SHOW_PATH').'clints/'.$data->photo,
					);
			   }
			
			if(count($list) > 0){
				 return  response()->json(['status'=>true,'message'=>'Our Clints Data','data'=>$list],200 );
			}
			else{
				$list = '';
				return $this->sendResponseData($list, 'No Record Found');
			}
			
            
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
		 
	}
	
	public function getEvent(Request $request ){			

		 try {		
		     $event =  NewsEvent::where('status',1)->where('role_id',2)->orderBy('id','DESC')->get();
		     
		     	$data = array();
			foreach ($event as $item) {
					$data[] = array(
					'id' => $item->id,
			       	'title' => $item->title,
					'date' => date('d', strtotime($item->date)),
					'month' => date('M', strtotime($item->date)),
					'time' => $item->time,
					'event_description' => $item->event_description,
					
					);
			}
		
			 return  response()->json(['status'=>true,'message'=>'success','event'=>$data ],200);        
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
		
	}
	
	public function email_subscription(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'email' => 'required|email|unique:news_leters,email',
			]
			);
			
			if($validator->fails()){            
    				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
    			
            $input = $request->all();
            $subscription = NewsLetter::create($input);
               
            $emailData = ['email'=>$request->email, 'subject' => 'Subcribed Successfully']; 
            $data = sendMail('admin.emails.news_letter',$emailData);
            
    				$success = '';	
    			
    				return $this->sendResponseData($success, 'Success',$data);   
			
		       if(!empty($data)){
    				  return  response()->json(['success'=>true,'message'=>'Email Sent Successfully','data'=>$data],200 );
              }
              
              else{
                  return  response()->json(['success'=>true,'message'=>'Email already exist','data'=>$data],200 );
              }
    			
			}
			
	 public function unsubscribe(Request $request)
    {
       
			    $unsubscribe =  NewsLetter ::where('email',$request->email)->delete();
    				$success = '';						
    				return $this->sendResponseData($success, 'Success',$unsubscribe);  
    	
    }	
	
	public function chat_text(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'message' => 'required'
			]
			);
			try {		
		     $input = $request->all();
            $chat_text = Chat::create($input);
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Chat Went Wrong');            
		}
			       
    			
			}
			
			
			public function getServices (Request $request, $page_name){	
			    
        try {			
			$data = Services::select('services.*','details.price','details.category','details.short_des','details.id as service_detail_id')
        ->leftjoin('service_details as details','details.service_id','services.id')->where('services.page_name',$page_name)->where('details.web_status',1)->take(3)->get();

            
	        $getMetaTag =  WebMeta::where('status',1)->where('page_name',$page_name)->get(['photo','tittle','meta_kyewords','meta_description']);
		    if($getMetaTag == "[]"){
		        $getMetaTag = "null";
		    }
		    return  response()->json(['status'=>true,'data'=>$data,'WebMeta'=>$getMetaTag,'message'=>"Service Detail Data"],200); 
                   
		} 
		catch (Exception $e) {
		    
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	public function uploadOrderDocument (Request $request,$id,$user_id){	
			    
        try {			
            
            	$order_document = OrderRequiredDocuments::select('order_required_documents.*','details.order_no','order_status.name as work_status')
        ->leftjoin('order_details as details','details.id','order_required_documents.order_id')
        ->leftjoin('status as order_status','order_status.id','details.status')->
        where('order_required_documents.order_id',$id)->where('order_required_documents.user_id',$user_id)->get();
            
            
				// $order_document = OrderRequiredDocuments ::where('order_id',$id)->where('user_id',$user_id)->get();
				$order_document_status = OrderRequiredDocuments ::where('order_id',$id)->where('user_id',$user_id)->where('status',0)->get();
              $documentList = array();
              $documentListStatus = array();
              $documentsCount =0;
              $uploadStatus ="";
              $expert_assigned = "";
			foreach ($order_document as $key =>$item) {
					$documentList[] = array(
					'id' => $item->id,
					'name' => $item->documents,
					'status' => $item->status,
					'files' => $item->files,
					'files_name' => $item->files_name,
					'order_no' => $item->order_no,
					'documents' => $item->documents,
					'work_status' => $item->work_status,
					
			       
					
					);
					 $documentsCount++;
					 
			}
			foreach ($order_document_status as $key =>$item) {
					$documentListStatus[] = array(
					'id' => $item->id,
					'name' => $item->documents,
					'status' => $item->status,
					'files' => $item->files,
					'files_name' => $item->files_name,
					'documents' => $item->documents,
			       
					
					);
				
					 
			}
			$order_document1 = OrderRequiredDocuments ::where('order_id',$id)->where('user_id',$user_id)->where('status',1)->count();
			$expert_assign_ca = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('ca_user_id')->first();
			$expert_assign_rm = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('rm_user_id')->first();
			$serviceDetail = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('service_detail_id')->first();
	//	dd($order_document1.'sasa'. $documentsCount);
	       
	      
	       $expertName_rm = User::select('mobile','name')->where('id', $expert_assign_rm)->first();
	        $expertName_ca = User::select('mobile','name')->where('id', $expert_assign_ca)->first();
	       if(empty($expertName_rm))
	       {
	           	$expertName_rm[] = array(
					'name' => null,
					'mobile' => null,
					
					);
	       }
	       if(empty($expertName_ca))
	       {
	           	$expertName_ca[] = array(
					'name' => null,
					'mobile' =>null,
					
					);
	       }
	       $serviceData =[];
	     
	       if(!empty($serviceDetail))
	       {
	           $getServiceDetail = ServiceDetail::where('id',$serviceDetail)->first();
	           	$serviceData[] = array(
					'data' => $getServiceDetail->short_des,
				);
		  }
	      
	           
	           ;
	        
			if($order_document1== $documentsCount)
			{
			    	
			  $uploadStatus=true;  
			}else
			{
			    $uploadStatus=false;
			}
			
			
            return  response()->json(['status'=>true,'message'=>'Chat Data','data'=>$documentList,'data2'=>$documentListStatus,'documentsCount'=>$uploadStatus,'expert_assigned_ca'=>$expertName_ca,'expert_assigned_rm'=>$expertName_rm,'serviceDetail'=>$serviceData],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	
	public function trackOrder(Request $request,$id,$user_id){	
			    
        try {			
				
			$documentsCount = OrderRequiredDocuments ::where('order_id',$id)->where('user_id',$user_id)->count();
			$order_document1 = OrderRequiredDocuments ::where('order_id',$id)->where('user_id',$user_id)->where('status',1)->count();
			$ca_assign = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('ca_user_id')->first();
			$rm_assign = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('rm_user_id')->first();
			$work_done = OrderDetail ::where('id',$id)->where('user_id',$user_id)->pluck('status')->first();
			$order_no = OrderDetail ::select('order_no','created_at')->where('id', $id)->first();
		
      
	        if($ca_assign== null){
	           $ca_assign = false; 
	        }else{
	             $ca_assign = true;
	        }
	        if($rm_assign== null){
	           $rm_assign = false; 
	        }else{
	             $rm_assign = true;
	        }
	        if($work_done== 13){
	           $work_done = true; 
	        }else{
	             $work_done = false;
	        }
	        
			if($order_document1== $documentsCount)
			{
			    	
			  $uploadStatus=true;  
			}else
			{
			    $uploadStatus=false;
			}
			
		

            return  response()->json(['status'=>true,'message'=>'Get Order Status','documentsCount'=>$uploadStatus,'expected_date'=>$order_no->created_at,'order_no'=>$order_no->order_no,'caAssign'=>$ca_assign,'rmAssign'=>$rm_assign,'work_done'=>$work_done],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	public function deleteOrder(Request $request,$id,$user_id){	
			    
        try {			
				

			$data = OrderDetail ::where('id',$id)->where('user_id',$user_id)->delete();
			
      
            return  response()->json(['status'=>true,'message'=>'Order Deleted Successfully'],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
			
			
	public function user_document (Request $request)   {
	   
		$validator = Validator::make($request->all(), [          
			'mobile' => 'required',
			'aadhar_no' => 'required',
 			'address' => 'required',
		    'pan_no' => 'required',
			'aadhar_image' => 'required',
			'pan_image' => 'required'
			]
			);
			try {		
		     
            $user = User::find($request->id);
            $user->update(['mobile'=>$request->mobile,'address'=>$request->address,'doc_status'=>0]);
            $user_doc = UserDocument::where('user_id',$request->id)->first();
           
           if(!empty($user_doc))
           {
               
               return $this->sendError('message', 'Documents are already updated');   
           }
           else
           {
                $user_document = new UserDocument;
		     $user_document->user_id = $user->id;
		     $user_document->pan_no = $request->pan_no;
		     $user_document->aadhar_no = $request->aadhar_no;
		     
		      $photo = "";
		      $photo1 = "";
         if($request->file('aadhar_image')){
            
                $image = $request->file('aadhar_image');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'user_documents';
                $image->move($destinationPath, $photo);
              }
         if($request->file('pan_image')){
            
                $image = $request->file('pan_image');
                $path = $image->getRealPath();      
                $photo1 =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'user_documents';
                $image->move($destinationPath, $photo1);
              }

		    $user_document->aadhar_image = $photo;
		    $user_document->pan_image = $photo1;
		    $user_document->save();
           
       
           }
          
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Something Went Wrong');            
		}
			       
	}
	
	
	
	public function getServiceDetail (Request $request){
	   
	   try{
	       	$data = ServiceDetail::select('service_details.*','service.name','service.id as s_id','service.ca_share')
        ->leftjoin('services as service','service.id','service_details.service_id')->where('service_details.id',$request->id)->first();
        
        return  response()->json(['status'=>true,'data'=>$data,'message'=>"Service Detail Data"],200); 
	   }
	   
	   catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
	    
	    
	}
	
	

		public function orderPurchased(Request $request)   {
		   $orderRepeatId =[];
		   $serId ="";
		$validator = Validator::make($request->all(), [          
		'email' => 'required|email'
			]
			);
 $val = (int)$request->plan_qty;
 $order_detail_id = "";

			try {	
			    
			    
			    
			    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                
                // shuffle the result
                $string = str_shuffle($pin);
        
		     $user = User::where('id',$request->user_id)->first();
		    
		     $serviceDetail = ServiceDetail::where('id',$request->service_id)->first();
		     $status_id = Services::where('id',$serviceDetail->service_id)->pluck('status_id')->first();
		   
		     
		    $status = array();
                if($status_id > 0){ 
                $status = explode(',', $status_id);
}



		     
	
		             $order_detail = new OrderDetail;
        		     $order_detail->user_id = $user->id;
        		     $order_detail->transaction_no = $request->transaction_no;
        		     $order_detail->order_no = $string;
        		     $order_detail->service_detail_id = $serviceDetail->id;
        		     $order_detail->service_id = $serviceDetail->service_id;
        		     $order_detail->amount = ($serviceDetail->price);
        		     $order_detail->payment_mode = $request->payment_mode;
        		     $order_detail->ca_share = $request->ca_share;
        		     $order_detail->coupon_id = $request->coupon_id;
        		     $order_detail->coupon_discount = $request->coupon_discount;
        		     $order_detail->coupon_code = $request->coupon_code;
        		     $order_detail->referral_id = $request->referral_id;
        		     $order_detail->status = $status[0];
        		     $order_detail->old_status = $status[0];
        		     if($request->up_to_discount == null)
        		     {
        		     $total = ($serviceDetail->price)-(($serviceDetail->price)*$request->coupon_discount/100);
        		     $order_detail->total_amount = $total + $total*18/100;
        		     }
        		     elseif( ($serviceDetail->price)*$request->coupon_discount/100  > $request->up_to_discount)
        		     {
        		             $total = ($serviceDetail->price-$request->up_to_discount)+(($serviceDetail->price - $request->up_to_discount)*18/100);
        		              $order_detail->total_amount = $total;
        		     }
        		     
        		     $order_detail->date = date('Y-m-d');
        		     $order_detail->save();
        		     $serId= $order_detail->service_id;
        		      array_push($orderRepeatId,$order_detail->id) ;
        		     $order_detail_id = $order_detail->id;
        		     
		     
		     	$service_document = ServiceDocuments ::where("service_id",$serviceDetail->service_id)->pluck('document_types_id')->first();
		     	$service_type = Services::where("id",$serviceDetail->service_id)->pluck('service_type_id')->first();
          
              	$data = array(); 
              	
              foreach(explode(',', $service_document) as $key=>$info) 
                {
                   $data[$key] = (Int)$info;
                }
               for($i=0; $i < count($data) ; $i++)
               {
                   $service_item = DocType::where('id',$data[$i])->first();
                    $order_documents = new OrderRequiredDocuments;
		     $order_documents->user_id = $user->id;
		     $order_documents->order_id = $order_detail->id;
		     $order_documents->documents = $service_item->name;
		       $order_documents->save();
		       }
               	$success = '';	
              	if($val > 1)
              	{
              	     for($i=1; $i<$val; $i++)
              	     {
              	          $task1 = OrderDetail::find($order_detail_id);
                        $new = $task1->replicate();
                      $new->save();
                      array_push($orderRepeatId,$new->id) ;
                      
                        for($i1=0; $i1 < count($data) ; $i1++)
               {
                   $service_item = DocType::where('id',$data[$i1])->first();
                    $order_documents = new OrderRequiredDocuments;
		     $order_documents->user_id = $user->id;
		     $order_documents->order_id = $new->id;
		     $order_documents->documents = $service_item->name;
		       $order_documents->save();
		        }
                
                     }
                     
                      for($i=0; $i<$val; $i++)
              	     {
              $task2 = new UserDocument;
		     $task2->user_id = $user->id;
		     $task2->order_id = $orderRepeatId[$i];
		       $task2->save();
              	     }
              	        return  response()->json(['status'=>true,'message'=>"Order Purchased Successfully",'serviceType'=>$service_type,'order_ids'=>$orderRepeatId],200); 
              	}
              	else
              	{
              	     for($i=0; $i<$val; $i++)
              	     {
              $task2 = new UserDocument;
		     $task2->user_id = $user->id;
		     $task2->order_id = $orderRepeatId[$i];
		       $task2->save();
              	     }
              	     
              	     return  response()->json(['status'=>true,'message'=>"Order Purchased Successfully",'serviceType'=>$service_type,'order_ids'=>$orderRepeatId],200); 
              	   	}
              	
    				
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
			} 
			catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		}
	
	public function getOrderList(Request $request,$user_id){			
        try {			
            $order_detail = OrderDetail::select('order_details.*','service.name','service.service_type_id','docs.doc_status','docs.view_user_info')
        ->leftjoin('services as service','service.id','order_details.service_id')
        ->leftjoin('user_documents as docs','docs.order_id','order_details.id')->groupBy('order_details.id')->where('order_details.user_id',$user_id)->orderBy('order_details.id','DESC')->get();
            $referral_code = User::where('id',$user_id)->pluck('referral_code')->first();
        
			$data  = array();
				foreach ($order_detail  as $item) {
					$data[] = array(
					'id' => $item->id,
					'name' => $item->name,
					'user_id' => $item->user_id,
					'service_id' => $item->service_id,
					'service_type_id' => $item->service_type_id,
					'service_detail_id' => $item->service_detail_id,
					'order_no' => $item->order_no,
					'doc_status' => $item->doc_status,
					'view_user_info' => $item->view_user_info,
					'payment_status' => $item->payment_status,
					'referral_id' => $item->referral_id,
					'status' => $item->status,
					'total_amount' => $item->total_amount,
					'created_at' =>date('d-M', strtotime($item['created_at'])),
					
					);
			}
	         
            return  response()->json(['status'=>true,'message'=>'Order Data','data'=>$data],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	public function getReferralCode(Request $request,$user_id){			
        try {			
        
            $referral_code = User::where('id',$user_id)->pluck('referral_code')->first();
            $referral_count = OrderDetail::where('referral_id',$user_id)->pluck('referral_id')->count();
        if(!empty($referral_code))
        {
              return  response()->json(['status'=>true,'message'=>'Referral Code','data'=>$referral_code,'referral_count'=>$referral_count],200 );       
            
        }
        else
        {
            $data= User::where('id',$user_id)->update(['referral_code'=>random_int(100000, 999999)]);
               $referral_code1 = User::where('id',$user_id)->pluck('referral_code')->first();
             return  response()->json(['status'=>true,'message'=>'Referral Code','data'=>$referral_code1,'referral_count'=>$referral_count],200 );   
        }
		
	         
          
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	
	public function editProfile(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'name' => 'required',
			'address' => 'required',
			'mobile' => 'required',
			'pan_no' => 'required',
			'aadhar_no' => 'required',
			'aadhar_image' => 'required',
			'pan_image' => 'required',
			
			]
			);
			try {		
		     
            $edit_profile = User::where('id',$request->id)->get()->first();
            $edit = UserDocument::where('user_id',$request->id)->get()->first();
           
              $photo = "";
		      $photo1 = "";
         if($request->file('aadhar_image')){
            
                $image = $request->file('aadhar_image');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'user_documents';
                $image->move($destinationPath, $photo);
                $edit->update(['aadhar_image' => $photo]);
              }
         if($request->file('pan_image')){
            
                $image = $request->file('pan_image');
                $path = $image->getRealPath();      
                $photo1 =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'user_documents';
                $image->move($destinationPath, $photo1);
                $edit->update(['pan_image' => $photo1]);
              }
              
       

		    $edit_profile->update(['name'=>$request->name,'address'=>$request->address,'mobile' => $request->mobile]);
		    
		   		    $edit->update(['aadhar_no'=>$request->aadhar_no,'pan_no'=>$request->pan_no]);
            
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Chat Went Wrong');            
		}
			       
    			
			}
			
		
		
		public function getNotification(Request $request ){			

		 try {		
		     $notification =  Notification::where('status',1)->get();
            
				$alert = array();
			foreach ($notification as $data) {
					$alert[] = array(
					'id' => $data->id,
					'message' => $data->message,
					'created_at' =>date('d-M', strtotime($data['created_at'])),
				        
					);
			   }
			
			if(count($alert) > 0){
				 return  response()->json(['status'=>true,'message'=>'Our Clints Data','data'=>$alert],200 );
			}
			else{
				$alert = '';
				return $this->sendResponseData($alert, 'No Record Found');
			}
			
            
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
		 
	}	
	
		public function getFaq(Request $request,$page_name){			

		 try {		
		     $faq =  Faq::where('status',1)->where('page_name',$page_name)->orderBy('id','DESC')->take(8)->get();
		    
				$list = array();
			foreach ($faq as $data) {
					$list[] = array(
					'id' => $data->id,
					'question' => $data->question,
					'answer' => $data->answer,
					);
			}
		
			if(count($list) > 0){
				 return  response()->json(['status'=>true,'message'=>'Faq Data','data'=>$list],200 );
			}
			else{
				$list = '';
				return $this->sendResponseData($list, 'No Record Found');
			}
			
          
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
	}
	
	
		public function getContacts(Request $request){			
        $validator = Validator::make($request->all(), [          
			'email' => 'required|email',
			'name' => 'required',
			'number' => 'required',
			'mobile' => 'required',
			'query' => 'required'
			]
			);
			try {		
			    $contacts =  Contacts ::where('page_name',$request->page_name)->get();
		     $input = $request->all();
            $contacts = Contacts ::create($input);
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		

    }
    
		public function getComments(Request $request){			
        $validator = Validator::make($request->all(), [          
			
			]
			);
			try {	
			    
			    if($request->replyOnComment)
			    {
			        $data = new BlogCommentReply;
		     $data->user_id = $request->replierUserId;
		       $data->reply = $request->comments;
		     $data->reply_user_id = $request->user_id;
		   
		     $data->blog_comment_id = $request->blogCommentId;
		     $data->save();
		     	$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			    }
			    else
			    {
			         $input = $request->all();
                        $comments = BlogComment::create($input);
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			    }
			    
		    
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		

    }
        
		public function blogLikes(Request $request){			
      
			$blog_likes=BlogLikes::where('user_id',$request->user_id)->where('blog_id',$request->blog_id)->first();
			
		if(!empty($blog_likes))
		{
		    $like_status = "";
		    $like_status_text = "";
		    if($blog_likes->likes == '1')
		    {
		        $like_status = 0;
		         $like_status_text = 0;
		    }
		    else
		    {
		         $like_status = 1;
		         $like_status_text = 1;
		    }
		    $data=BlogLikes::where('user_id',$request->user_id)->where('blog_id',$request->blog_id)->update(['likes'=>$like_status]);
		         return  response()->json(['status'=>true,'message'=>"Blog Liked",'data'=>$like_status_text],200); 
		}
		else
		{
		    	try {	
			   $data = new BlogLikes;
		     $data->user_id = $request->user_id;
		     $data->likes = 1;
		     $data->blog_id = $request->blog_id;
		     $data->save();
		      return  response()->json(['status'=>true,'message'=>"Blog Liked",'data'=>"Liked"],200); 
			   
			   	
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		    
		}
			            return  response()->json(['status'=>true,'message'=>"Blog Like Share Data",'data'=>$blog_likes],200); 

    }
    
    
    	public function blogShared(Request $request){			
      
			$blog_shared=BlogLikes::where('user_id',$request->user_id)->where('blog_id',$request->blog_id)->first();
			
		if(!empty($blog_shared))
		{
		 
		    
		    /*if($blog_shared->likes == '1')
		    {
		        $share_status = 0;
		         $share_status_text = 0;
		    }
		    else
		    {
		         $share_status = 1;
		         $share_status_text = 1;
		    }
		    */
		    $data=BlogLikes::where('user_id',$request->user_id)->where('blog_id',$request->blog_id)->increment('share', 1);
		         return  response()->json(['status'=>true,'message'=>"Blog Liked",'data'=>"dd"],200); 
		}
		else
		{
		    	try {	
			   $data = new BlogLikes;
		     $data->user_id = $request->user_id;
		     $data->share = 1;
		     $data->blog_id = $request->blog_id;
		     $data->save();
		      return  response()->json(['status'=>true,'message'=>"Blog Liked",'data'=>"Liked"],200); 
			   
			   	
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		    
		}
			            return  response()->json(['status'=>true,'message'=>"Blog Like Share Data",'data'=>$blog_likes],200); 

    }
    
    
        
    
		public function getOrderInvoice(Request $request,$order_id){			
       
		try {		
		     $order_details =  OrderDetail ::where('id',$order_id)->get();
		     
		return  response()->json(['status'=>true,'data'=>$order_details ,'message'=>"Order Details"],200);     
		
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}

    }
    
		public function getCoupon(Request $request){			
        
			try {		
			    $coupon = Coupon::where('coupon_code',$request->coupon)->where('status',0)->whereDate('from_date', '<=', date("Y-m-d"))->whereDate('to_date', '>=',date("Y-m-d"))->get();
            	if(count($coupon)>0){            
			 return  response()->json(['status'=>true,'message'=>'Coupon Code','coupon_code'=>$coupon],200 );
			    }else{
			         return  response()->json(['status'=>false,'message'=>'Coupon Code','coupon_code'=>$coupon],200 );
			    }
            
		      } 
            	catch (Exception $e) {
		    	return $this->sendError('message', 'Somthing Went Wrong');            
		   }
		        }
    
		public function editProfileImage(Request $request){	
        $validator = Validator::make($request->all(), [          
			'photo' => 'required'
			]
			);
			try {		
			    $data =  User ::find($request->id);
			   
        $photo = "";
         if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'profile';
                $image->move($destinationPath, $photo);
              }
         $data->update(['photo' => $photo]);
         $updatedImage = User ::find($request->id);
         $image = env('IMAGE_SHOW_PATH').'profile/'.$updatedImage->photo;
    				 return  response()->json(['status'=>true,'message'=>'Image Updated Successfully','updatedImage'=>$image],200 );
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		

    }
    
    public function userGstinDetails(Request $request)   {
		$validator = Validator::make($request->all(), [          
			'gstin' => 'required',
			'firm_name' => 'required',
			'firm_address' => 'required',
			'pin_code' => 'required',
			]
			);
			try {		
		     $input = $request->all();
            $gstin = UserGstin::create($input);
    				$success = '';						
    				return $this->sendResponseData($success, 'Success');   
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Chat Went Wrong');            
		}
			       
    			
			}
    
    		public function orderDocument(Request $request){	
        $validator = Validator::make($request->all(), [          
			'id' => 'required',
			'files' => 'required'
			]
			);
			try {		
			    $data =  OrderRequiredDocuments ::find($request->id);
                    
        $document = "";
         if($request->file('files')){
            
                $image = $request->file('files');
                $path = $image->getRealPath();      
                $document =  time().$image->getClientOriginalName();
                $destinationPath = public_path('images/orderDocuments/');
                $image->move($destinationPath, $document);
              }
              
              $document1 = "";
         if($request->file('files')){
            
                $image = $request->file('files');
                $path = $image->getRealPath();      
                $document1 =  $image->getClientOriginalName();
                
              }
              
              
         $data->update(['files' => $document,'status'=>1,'files_name'=>$document1,'password'=>$request->password]);
    				 return  response()->json(['status'=>true,'message'=>'document uploaded Successfully'],200 );
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		

    }
    		public function miscellaneousDocument(Request $request){	
        $validator = Validator::make($request->all(), [          
// 			'id' => 'required',
// 			'files' => 'required'
			]
			);
			try {		
                    
        $document = "";
         if($request->file('files')){
            
                $image = $request->file('files');
                $path = $image->getRealPath();      
                $document =  time().$image->getClientOriginalName();
                $destinationPath = public_path('images/orderDocuments/');
                $image->move($destinationPath, $document);
              }
              
              $document1 = "";
         if($request->file('files')){
            
                $image = $request->file('files');
                $path = $image->getRealPath();      
                $document1 =  $image->getClientOriginalName();
                
              }
              
               $data = new OrderRequiredDocuments;
		     $data->files = $document;
		     $data->files_name = $document1;
		     $data->password = $request->password;
		     $data->documents = $request->documents;
		     $data->order_id = $request->order_id;
		     $data->user_id = $request->user_id;
		     $data->status = 1;
		     $data->save();
              
             
    				 return  response()->json(['status'=>true,'message'=>'document created and submitted Successfully'],200 );
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
		

    }
   
	public function downloadOrderDocuments(Request $request){
        $download = OrderRequiredDocuments::find($request->id);
        $image =  'https://accounts.rusoft.in/public/images/orderDocuments/'.$download['files'];
       // return Response::download($image);

        return  response()->json(['status'=>true,'message'=>'File Found','file_url'=>$image],200 );
        
}


    public function userPersonalInfo(Request $request)   {

  	      
			
			try {		
            $user_document  = UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id);
            $user_document->update
            (['cin'=>$request->cin,
            'company_name'=>$request->company_name,
            'incorporation_date'=>$request->incorporation_date,
            'fathers_name'=>$request->fathers_name,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'pan_no'=>$request->pan_no,
            'first_name'=>$request->first_name,
           
            'last_name'=>$request->last_name,
            'aadhar_no'=>$request->aadhar_no,]);
            
            
          $service_id = OrderDetail:: where('id', $request->order_id)->first('service_id');
            $service_type_id = Services:: where('id', $service_id->service_id)->first('service_type_id');
            
             $serviceType = ServicesType :: where("id",$service_type_id->service_type_id)->pluck("required_field")->first();
        	       	
        	       	$data1=[];
        	       	 foreach(explode(',', $serviceType) as $info) 
        	       	 {
                     $data1[] = $info;
        	       	 }

        	       	$data = UserDocument :: where("order_id",$request->order_id)->where("user_id",$request->user_id)->first($data1);
        	       	$required_fields = [];
        	       	$count =0;
        	       	
        	       		foreach ($data1  as $item) {
        	       		    
        	       		    if($data->$item == null)
        	       		    {
        	       		        $count++;
        	       		        $required_fields[] = $item;
        	       		    }
				
			}
            if($count == 0)
            {
                 $user_document->update
            (['view_user_info'=>1,
            ]);
            }
            // $user  = User::where('id',$request->user_id);
            // $user->update
            // (['first_name'=>$request->first_name,
            // 'last_name'=>$request->last_name,]);
            
    			 return  response()->json(['status'=>true,'message'=>'Persnol Info Saved Successfully'],200 );
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somethig went wrong');            
		}
			       
    			
			}
    public function userAddress(Request $request)   {
          
            // $user_document  = UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id)->first();
            if($request->isMethod('post')){

			try {		
            $user_document  = UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id);
            $user_document->update
            (['code'=>$request->code,
            'state'=>$request->state,
            'house_no'=>$request->house_no,
            'pincode'=>$request->pincode,
            'mobile'=>$request->mobile,
            'area'=>$request->area,
            'email'=>$request->email,
            'city'=>$request->city]);
            
       $service_id = OrderDetail :: where('id', $request->order_id)->first('service_id');
            $service_type_id = Services :: where('id', $service_id->service_id)->first('service_type_id');
            
             $serviceType = ServicesType :: where("id",$service_type_id->service_type_id)->pluck("required_field")->first();
        	       	
        	       	$data1=[];
        	       	 foreach(explode(',', $serviceType) as $info) 
        	       	 {
                     $data1[] = $info;
        	       	 }

        	       	$data = UserDocument :: where("order_id",$request->order_id)->where("user_id",$request->user_id)->first($data1);
        	       	$required_fields = [];
        	       	$count =0;
        	       	
        	       		foreach ($data1  as $item) {
        	       		    
        	       		    if($data->$item == null)
        	       		    {
        	       		        $count++;
        	       		        $required_fields[] = $item;
        	       		    }
				
			}
            if($count == 0)
            {
                 $user_document->update
            (['view_user_info'=>1,
            ]);
            }
            
            // $user  = User::where('id',$request->user_id);
            // $user->update
            // (['mobile'=>$request->mobile]);
            
    			 return  response()->json(['status'=>true,'message'=>'Persnol Info Saved Successfully'],200 );
    			
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somethig went wrong');            
		}
            } 
            
    			
			}
			
			
			public function getUserAddress (Request $request){
        	   
        	   try{
        	       //	$data = User::select('users.id as user_id','users.mobile','users.email','document.house_no','document.area','document.pincode','document.city','document.state','document.code')
	               //              ->leftjoin('user_documents as document','document.user_id','users.id')->where('users.id',$request->user_id)->first();
	               
	                $docs= UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id)->get();
              
                			$data  = array();
				foreach ($docs  as $item) {
					$data[] = array(
	                'user_id' => $item->user_id,
	                'order_id' => $item->order_id,
					'mobile' => $item->mobile,
					'email' => $item->email,
					'house_no' => $item->house_no,
					'area' => $item->area,
				
					'pincode' => $item->pincode,
				
					'city' => $item->city,
					'state' => $item->state,
					'code' => $item->code,
			
					);
			}
	               
                
                return  response()->json(['status'=>true,'message'=>"User Data",'data'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
			public function getUserInfo (Request $request){
        	   
        	   try{
        	       //	$data = User::select('users.id as user_id','document.order_id','users.first_name','users.last_name','document.cin','document.company_name','document.incorporation_date'
        	       //	                        ,'document.gender','document.dob','document.fathers_name','document.pan_no','document.aadhar_no')
	               //              ->leftjoin('user_documents as document','document.user_id','users.id')->where('users.id',$request->user_id)->where('users.id',$request->user_id)->get()->first();
                    
                $docs= UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id)->get();
              
                			$data  = array();
				foreach ($docs  as $item) {
					$data[] = array(
	                'user_id' => $item->user_id,
					'order_id' => $item->order_id,
					'first_name' => $item->first_name,
					'last_name' => $item->last_name,
					'cin' => $item->cin,
				
					'company_name' => $item->company_name,
				
					'incorporation_date' => $item->incorporation_date,
					'gender' => $item->gender,
					'dob' => $item->dob,
					'fathers_name' => $item->fathers_name,
					'pan_no' => $item->pan_no,
					'aadhar_no' => $item->aadhar_no,
			
					
					);
			}
                    
                    
                    
                return  response()->json(['status'=>true,'message'=>"User Data",'data'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
        	
			public function getUserBank(Request $request){
        	   
        	   try{
        	       //	$data = User::select('users.id as user_id','document.ifsc','document.bank_name','document.bank_account_no')
	               //              ->leftjoin('user_documents as document','document.user_id','users.id')->where('users.id',$request->user_id)->get()->first();
                     $docs= UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id)->get();
              
                			$data  = array();
				foreach ($docs  as $item) {
					$data[] = array(
	                'user_id' => $item->user_id,
	                'order_id' => $item->order_id,
					'ifsc' => $item->ifsc,
					'bank_name' => $item->bank_name,
					'bank_account_no' => $item->bank_account_no,
			       
					);
			}
                    
                return  response()->json(['status'=>true,'message'=>"User Data",'data'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
        	
			public function userBank(Request $request)   {

			try {		
            $user_document  = UserDocument::where('user_id',$request->user_id)->where('order_id',$request->order_id);
            $user_document->update
            (['ifsc'=>$request->ifsc,
            'bank_name'=>$request->bank_name,
              'doc_status'=>0,
            'bank_account_no'=>$request->bank_account_no]);
            
            $service_id = OrderDetail :: where('id', $request->order_id)->first('service_id');
            $service_type_id = Services :: where('id', $service_id->service_id)->first('service_type_id');
            
             $serviceType = ServicesType :: where("id",$service_type_id->service_type_id)->pluck("required_field")->first();
        	       	
        	       	$data1=[];
        	       	 foreach(explode(',', $serviceType) as $info) 
        	       	 {
                     $data1[] = $info;
        	       	 }

        	       	$data = UserDocument :: where("order_id",$request->order_id)->where("user_id",$request->user_id)->first($data1);
        	       	$required_fields = [];
        	       	$count =0;
        	       	
        	       		foreach ($data1  as $item) {
        	       		    
        	       		    if($data->$item == null)
        	       		    {
        	       		        $count++;
        	       		        $required_fields[] = $item;
        	       		    }
				
			}
            if($count == 0)
            {
                 $user_document->update
            (['view_user_info'=>1,
            ]);
            }
            
    			 return  response()->json(['status'=>true,'message'=>'Bank Details Saved Successfully'],200 );
			
		if($validator->fails()){            
				return $this->sendError('Validation Error.', $validator->messages()->first());
			}
            
		} 
		
		catch (Exception $e) {
			return $this->sendError('message', 'Somethig went wrong');            
		}
			       
    			
			}
			
			
			public function getStates (Request $request){
        	   
        	   try{
        	       	$states = State :: where('country_id','101')->get();
                
                return  response()->json(['status'=>true,'message'=>"All States",'states'=>$states],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
			public function getWallet (Request $request){
        	   
        	   try{
        	       	$wallet = Wallet :: where('user_id',$request->user_id)->where('status',0)->get('amount');
        	       	$walletDetails = WalletDetail :: where('user_id',$request->user_id)->get(['user_id_form','user_id_to','amount','status','created_at']);
        	      
        	      
        	     	$data  = array();
        	     	
				foreach ($walletDetails  as $item) {
				    
				    $th = "";
				    $referar = "...";
				    $user = User:: where('id',$item->user_id_form)->first();
				    if(!empty($user))
				    {
				        $referar = $user->name;
				          $th ="Refer By";
				    }
				    else{
				         $user = User:: where('id',$item->user_id_to)->first();
				          if(!empty($user))
				    {
				        $referar = $user->name;
				         $th ="Refer To";
				    }
				         
				    }
					$data[] = array(
	                'th_heading' => $th,
	                'refer_by' => $referar,
	                'amount' => $item->amount,
					'status' => $item->status,
					'created_at' => $item->created_at
			       
					);
			}
        	      if(count($wallet) > 0)
        	      {
        	          
        	      }
        	      else
        	      
        	      {
        	          	$wallet[] = array(
	                'amount' => 0
					);
        	      }
                return  response()->json(['status'=>true,'message'=>"Wallet Details",'data'=>$wallet,'data2'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
		
        	
        	
			public function getCitys (Request $request){
        	   
        	   try{
        	       	$citys = City :: get();
                
                return  response()->json(['status'=>true,'message'=>"All Citys",'citys'=>$citys],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
			public function getServiceName (Request $request){
        	   
        	   try{
        	       	$service_name = Services :: where("page_name",$request->pageName)->first();
        	       	$route = Route :: where("route",$request->pageName)->first('page_name');
        	       	$service_type_name = ServicesType :: where("id",$service_name->service_type_id)->first('name');
                
                return  response()->json(['status'=>true,'message'=>"Service Name Fetched",'data'=>$service_name,'service_type_name'=>$service_type_name,'route'=>$route],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
			public function getServiceType (Request $request,$service_type_id){
        	   
        	   try{
        	       	$serviceType = ServicesType :: where("id",$service_type_id)->pluck("required_field")->first();
        	       	
        	       	$data=[];
        	       	 foreach(explode(',', $serviceType) as $info) 
        	       	 {
   $data[] = $info;
        	       	 }
                
                return  response()->json(['status'=>true,'message'=>"Service Type Fetched",'allowed_input'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
			public function docTypeMatch (Request $request){
        	   
        	   try{
        	       
        	       $serviceType = ServicesType :: where("id",$request->service_type_id)->pluck("required_field")->first();
        	       	
        	       	$data1=[];
        	       	 foreach(explode(',', $serviceType) as $info) 
        	       	 {
                     $data1[] = $info;
        	       	 }

        	       	$data = UserDocument :: where("order_id",$request->order_id)->where("user_id",$request->user_id)->first($data1);
        	       	$required_fields = [];
        	       	$count =0;
        	       	
        	       		foreach ($data1  as $item) {
        	       		    
        	       		    if($data->$item == null)
        	       		    {
        	       		        $count++;
        	       		        $required_fields[] = $item;
        	       		    }
				
			}
        	       	
                
                return  response()->json(['status'=>true,'message'=>"User Document List",'data'=>$data,'count'=>$count,'required_fields'=>$required_fields],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
			public function getServicesName (Request $request){
        	   
        	   try{
        	       	$serviceType = ServicesType ::where('status',1)->orderBy('id','ASC')->get();
        	    
        	   
        	       	$data  = array();
        	       	
        	       		foreach ($serviceType  as $item) {
        	       		   	$data1  = array();
        	       		    $dropdown = ServiceTypesDropdown::where('service_type_id',$item->id)->orderBy('id','ASC')->get();
        	       		    
        	       		    
        	       		    	foreach ($dropdown  as $item1) {
        	       		    	    	$data1[] = array(
	                'name' => $item1->name,
	                'id' => $item1->id,
	               
					);
        	       		    	    
        	       		    	}
					$data[] = array(
	                'service_name' => $item->name,
	                'id' => $item->id,
	                'dropdown' => $data1,
	               
					);
			}
                
            
				
                return response()->json(['status'=>true,'message'=>"Service Fetched",'services'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
			public function getServicesTypes (Request $request,$type_id){
        	   
        	   try{
        	       	$serviceType = ServiceSubType :: where('service_type_id',$type_id)->where('status',1)->orderBy('id','ASC')->get();
        	       
        	       	$data  = array();
        	       		foreach ($serviceType  as $item) {
		$data1  = array();
        	       		    	$serviceRoutes = Route::where('service_sub_type_id',$item->id)->orderBy('order_By','ASC')->get();
        	       		    	foreach ($serviceRoutes  as $item1) {
        	       		    	    
        	       		    	$data1[] = array(
	                'id' => $item1->id,
	                'name' => $item1->page_name,
	                'route' => $item1->route,
	               
					);
        	       		    	}
					
					$data[] = array(
	                'id' => $item->id,
	                'name' => $item->name,
	                'service_type_id' => $item->service_type_id,
	                'routes' => $data1,
	                'status' => $item->status,
					);
			}
                
            
				
                return response()->json(['status'=>true,'message'=>"Service Fetched",'services'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
        
        	
        				public function getServicesTypesDropdown (Request $request,$dropdown_id){
        	   
        	   try{
        	       
        	       	$data  = array();
        	       	 $dropdown = ServiceSubType::where('service_type_dropdown_id',$dropdown_id)-> orderBy('id','ASC')->get();
        	       		   
        	       		foreach ($dropdown  as $item) {
        	       		   	$data1  = array();
        	       		   $route = Route::where('service_sub_type_id',$item->id)->orderBy('order_By','ASC')->get();
        	       		    
        	       		    	foreach ($route  as $item1) {
        	       		    	    	$data1[] = array(
	                
                    'id' => $item1->id,
	                'name' => $item1->page_name,
	                'route' => $item1->route,
					'order_By' => $item1->order_By,
	               
					);
        	       		    	    
        	       		    	}
					$data[] = array(
	                'id' => $item->id,
	                'name' => $item->name,
	                'routes' => $data1,
	                'status' => $item1->status,
					);
			}
        	      
        	       	
        
				
                return response()->json(['status'=>true,'message'=>"List Fetched",'data'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}

			public function getMyDocuments (Request $request,$user_id){
        	   
        	   try{
        	       $order_detail = OrderRequiredDocuments::select('order_required_documents.*','details.service_id')
            	 ->leftjoin('order_details as details','details.id','order_required_documents.order_id')->
        	       
                     where('order_required_documents.user_id',$user_id)->groupBy('order_required_documents.order_id')->where('details.payment_status',1)->get();
                     
                     
            	$data  = array();
            
            
            	
            // 	 $order_detail2 = OrderRequiredDocuments::select('order_required_documents.*','details.service_detail_id')
            // 	 ->leftjoin('order_details as details','details.id','order_required_documents.order_id')->
        	       
            //          where('order_required_documents.user_id',$user_id)->get();
            	
            	 
				foreach ($order_detail  as $item) {
				   $order_detail1 = OrderRequiredDocuments::select('order_required_documents.*')->
        	       
                     where('order_required_documents.user_id',$user_id)->where('order_required_documents.order_id',$item->order_id)->get();
                     
                      $service_name = Services ::where('id', $item->service_id)->pluck('name')->first();
                     	$doc_name  = array();
                     	foreach ($order_detail1  as $item) {
				 
					$doc_name[] = array(
	               'doc' => $item->documents,
	               'files' => $item->files,
	               'id' => $item->id,
			
			       
					);
				}
					$data[] = array(
	               'order_id' => $item->order_id,
	               'service_name' => $service_name,
				  'doc_name' =>$doc_name,
			       
					);
                     
				}
                     
                 return  response()->json(['status'=>true,'message'=>"Service Name Fetched",'data'=>$data],200); 
        	   }
        	   
        	   catch (Exception $e) {
        			return $this->sendError('message', 'Somthing Went Wrong');            
        		}
        	    
        	    
        	}
        	
        		public function getReferral (Request $request){
	   
	   try{
	       	$user = User::where('referral_code',$request->referral_code)->get();
	       		$data  = array();
         	foreach ($user  as $item) {
				 
					$data[] = array(
	               'id' => $item->id,
	               'name' => $item->name,
	               'referral_code' => $item->referral_code,
	               'email' => $item->email,
			
			       
					);
					
				
				  
				}
         
        return  response()->json(['status'=>true,'data'=>$data,'message'=>"Get Referral Code Details"],200); 
	   }
	   
	   catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
	    
	    
	}
        		public function getCalender (Request $request){
	   
	   try{
	       	$calender = Calender::where('status',0)->get();
	       		$data  = array();
         	foreach ($calender  as $item) {
				 
					$data[] = array(
	               'id' => $item->id,
	               'name' => $item->name,
	               'date' => date('F/d/Y', strtotime($item->date)),
	               'type' => $item->type,
	               'everyYear' => false,
	               'color' => $item->color_code,
				);
				}
         
        return  response()->json(['status'=>true,'data'=>$data,'message'=>"Get Calender Data"],200); 
	   }
	   
	   catch (Exception $e) {
			return $this->sendError('message', 'Somthing Went Wrong');            
		}
	    
	    
	}
	

	}
