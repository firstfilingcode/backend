<?php    
namespace App\Http\Controllers\Admin\Ca;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Chat;
use App\Models\OrderRequiredDocuments;
use App\Models\DocType;
use App\Models\OrderReimbursement;
use App\Models\OrderInvoice;
use App\Models\OrderDocumentSendToClient;
use App\Models\EmailTamplate;
use App\Models\Status;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
use Storage;
use Image;
use Session;
use Auth;
use Response;
use Validator;
class CAManagementController extends Controller
{
   
   
    public function ca_find_orders(Request $request)
    {
        $data = 0;
      
         $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.name as user_name','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.ca_user_id',Auth::user()->id); 
         
           
        if($request->isMethod('post')){
            
        if($request->tab_type == "awaiting_acceptance"){        
           $data = $data->where('order_details.ca_approval_status',0);
        }
        
        if($request->tab_type == "active_order"){        
           $data = $data->whereIn('order_details.status',[2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20,21,22]);
        }
        if($request->tab_type == "Caseonhold"){        
           $data = $data->where('order_details.CaseOnHold','yes');
        }
        if($request->tab_type == "workdone"){        
           $data = $data->where('order_details.status',13);
        }
        
        if($request->from_date!="" || $request->to_date!=""){        
           $data = $data->whereBetween('order_details.date', [$request->from_date, $request->to_date]);
        }
        if($request->service_id!="" ){     
           
           $data = $data->where('order_details.service_id',$request->service_id);
        }
         if($request->ca_user_id!="" ){     
           
           $data = $data->where('order_details.ca_user_id',$request->ca_user_id);
        }
        if($request->user_id!="" ){     
           
           $data = $data->where('order_details.user_id',$request->user_id);
        }
        if($request->rm_user_id!="" ){     
           
           $data = $data->where('order_details.rm_user_id',$request->rm_user_id);
        }
        if($request->status_id!="" ){        
           $data = $data->whereIn('order_details.status',explode(',',$request->status_id));
        }
        if($request->order_id!="" ){        
           $data = $data->where('order_details.order_no',$request->order_id);
        }
        if($request->email!="" ){        
           $data = $data->where('users.email',$request->email);
        }
        if($request->mobile!="" ){        
           $data = $data->where('users.mobile',$request->mobile);
        }
        if($request->sp_share!="" ){        
           $data = $data->where('order_details.ca_share',$request->sp_share);
        }
        
        
        }else{
            $data = $data->where('order_details.ca_approval_status',0);
        }
         $data = $data->orderBy('order_details.id','DESC')->get();
		 return view('ca.find_order',compact('data'));
    }
   
    public function ca_view_order(Request $request,$id)
    {
          
        $data = OrderDetail::select('order_details.*','services.name as service_name','service_details.short_des as service_covered','services.service_type_id as service_type_id','services.status_id as status_id','users.email as user_email','users.mobile as user_mobile')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.id',$id)->get()->first();
        $order = OrderDetail::where('id', $id)->update(['ca_new_order' => 0]);
		 return view('ca.view_order',compact('data'));
    }
    
    
     public function message_send(Request $request){
       $request->validate([
        'message' => 'required',
    ]);
      $id = $request->order_id;
     $orderData = getorderData($id);
         
            if(!empty($orderData->user_email)){
            $emailSetting = EmailTamplate::where('category','users_chat')->first();
                 $message = !empty($emailSetting->email_description) ? $emailSetting->email_description : '' ;
            $message_des = str_replace(array('{#Message#}'), array($request->message), $message);
 
         $emaildata = ['email'=>$orderData->user_email,'data'=>$message_des,'subject'=>$emailSetting->title];
        sendMail('admin.emails.order',$emaildata);
        }
        
         $rmdata = User::find($orderData->rm_user_id);
        if(!empty($rmdata)){
        $emailSetting1 = EmailTamplate::where('category','rm_chat')->first();
                $message1 = !empty($emailSetting1->email_description) ? $emailSetting1->email_description : '' ;
                $btn = '<a class="btn btn-warning text-white" href="'.url('admin/order_edit/'.$id).'">Click Here</a>';
            $message_des1 = str_replace(array('{#clickbutton#}', '{#Message#}'), array($btn,$request->message), $message1);
 
         $emaildata = ['email'=>$rmdata['email'],'data'=>$message_des1,'subject'=>$emailSetting1->title];
        sendMail('admin.emails.order',$emaildata);
        }
        $cadata = User::find($orderData->ca_user_id);
        if(!empty($cadata)){
        $emailSetting2 = EmailTamplate::where('category','ca_chat')->first();
            $message = !empty($emailSetting2->email_description) ? $emailSetting2->email_description : '' ;
            $btn = '<a class="btn btn-warning text-white" href="'.url('admin/ca_view_order/'.$id).'">Click Here</a>';
            $message_des2 = str_replace(array('{#clickbutton#}', '{#Message#}'), array($btn,$request->message), $message);
 
         $emaildata = ['email'=>$cadata['email'],'data'=>$message_des2,'subject'=>$emailSetting1->title];
        sendMail('admin.emails.order',$emaildata);
        }
        
        
         $input = $request->all();
            $user = Chat::create($input);
            	$message =Chat::select('chats.*','user.name as user_name')->leftjoin('users as user','user.id','chats.user_id')->where('order_id',$request->order_id)->get();
		   $stateData ='';
        foreach($message as $mess){
            if(Auth::user()->id == $mess->user_id){
           $stateData.='
                              <div class="post "> <div class="user-block mb-1">
                               <span>
                                <a href="#">You</a>
                                </span>
                                <span class="description ml-0"> '.  date('d-m-y / H:m:A', strtotime($mess->created_at)) .'</span>
                                </div>
                                
                                <p>'.
                               $mess->message .'
                                </p>
                               
                                </div>';
                            }else{
                            $stateData.='
                            <div class="post "> <div class="user-block mb-1">
                               <span>
                                <a href="#">'.$mess->user_name .'</a>
                                </span>
                                <span class="description ml-0"> '.  date('d-m-y / H:m:A', strtotime($mess->created_at)) .'</span>
                                </div>
                                
                                <p>'.
                               $mess->message .'
                                </p>
                               
                                </div>';            
                
               }
           }
           
           
           echo $stateData;
	}
	 
	  public function status_message($order_id,$messag,$user_id){
    
     $orderData = getorderData($order_id);
        
             $Chat = new Chat;
    	     $Chat->user_id = $user_id;
    	     $Chat->order_id = $order_id;
    	     $Chat->message = html_entity_decode($messag);
             $Chat->save();
         return '';
           
	}
	
	 public function status_comment(Request $request){
       $id = $request->order_id;
       
      $oldData = OrderDetail::find($id);
     
       $old_status = array();
        if($oldData->old_status > 0){ 
        $old_status = explode(',', $oldData->old_status);
         }
       $array2 = array($request->status_id);
       $result = array_merge($old_status, $array2);
        $old_status_id = "";
             if(!empty($result)){
            $old_status_id = implode(',', $result);
             }
        $order = OrderDetail::where('id', $id)->update(['status' => $request->status_id,'old_status' => $old_status_id,'status_comment' => $request->status_comment]);
        
        
		 if($request->status_id == 13){
		     $orders = OrderInvoice::where('order_id',$id)->get()->first();
		     if(!empty($orders)){
		         $orders =$orders;
		     }else{
		         $orders = new OrderInvoice;
		     }
		
    	     $orders->user_id = $oldData['user_id'];
    	     $orders->order_id = $id; 
    	  
    	     $orders->save();
		 }
		 //email 
/*		 $orderData = getorderData($id);
		 $cadata = User::find($orderData->ca_user_id);
		 $orderMess = Status::find($request->status_id);
         $message = !empty($orderMess->status_massage) ? $orderMess->status_massage : '' ;
             $this->status_message($request->order_id,$message,Auth::user()->id);
		 
		  if(!empty($cadata['email'])){
		      $btn = '<a class="btn btn-warning text-white" href="'.url('admin/ca_view_order/'.$id).'">Click Here</a>';
            $message_des = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message);
		      $emaildata = ['email'=>$cadata['email'],'data'=>$message_des,'subject'=>$orderData->order_no];
            sendMail('admin.emails.order_status',$emaildata);
        }
        
        
        
         $rmdata = User::find($orderData->rm_user_id);
         
        if(!empty($rmdata)){
            $btn = '<a class="btn btn-warning text-white" href="'.url('admin/order_edit/'.$id).'">Click Here</a>';
            $message_des = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message);
		      $emaildata = ['email'=>$rmdata['email'],'data'=>$message_des,'subject'=>$orderData->order_no];
        sendMail('admin.emails.order_status',$emaildata);
        }
        
         if(!empty($orderData->user_email)){
            $btn = '<a class="btn btn-warning text-white" href="'.url('admin/order_edit/'.$id).'">Click Here</a>';
            $message_des = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message);
            
         $emaildata = ['email'=>$orderData->user_email,'data'=>$message_des,'subject'=>$orderData->order_no];
        sendMail('admin.emails.order_status',$emaildata);
        }*/
        
		     
          return response()->json(['status'=>true,'message'=>'status Update successfully'],200 );
	}
	
	public function order_priority(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['priority_comment' => $request->priority_comment,'priority' => $request->priority]);
		   
          return response()->json(['status'=>true,'message'=>'priority Update successfully'],200 );
	}
	
	public function ca_approval_status(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['ca_approval_status' => $request->ca_approval_status]);
		   
          return response()->json(['status'=>true,'message'=>'Approval Status Update successfully'],200 );
	}
	
	public function order_case_type(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['case_type' => $request->case_type]);
		   
          return response()->json(['status'=>true,'message'=>'Case Type Update successfully'],200 );
	}
	
		public function private_comment(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['private_comment' => $request->private_comment]);
		   
          return response()->json(['status'=>true,'message'=>'Private Comment Update successfully'],200 );
	}
    
    public function acknowledgement_no(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['acknowledgement_no' => $request->acknowledgement_no]);
		   
          return response()->json(['status'=>true,'message'=>'Acknowledgement No Update successfully'],200 );
	}
	
	public function document_request(Request $request){
	 
       foreach ($request->document_type_id as $key => $item) {
             $service_item = DocType::where('id',$item)->first();
    		 $order_documents = new OrderRequiredDocuments;
    	     $order_documents->user_id = $request->user_id;
    	     $order_documents->order_id = $request->order_id;
    	     $order_documents->document_type_id = $service_item->id;
    	     $order_documents->documents = $service_item->name;
    	     $order_documents->save();
				
	}
	 if(Auth::user()->role_id == 3 ){
             	 return redirect('admin/ca_view_order/'.$request->order_id)->with('success','Request Documents Successfully');

         }else{
             	 return redirect('admin/order_edit/'.$request->order_id)->with('success','Request Documents Successfully');

         }
	}
	
		public function update_rm(Request $request){
	      $id = $request->order_id;
          $order = OrderDetail::where('id', $id)->update(['rm_user_id' => $request->rm]);
      
        $orderData = getorderData($id);
         $rmdata = User::find($request->rm);
		  if(!empty($rmdata['email'])){
		       $emailSetting = EmailTamplate::where('category','rm_assign')->first();
                 $message = !empty($emailSetting->email_description) ? $emailSetting->email_description : '' ;
                 $btn = '<a class="btn btn-warning text-white" href="'.url('admin/order_edit/'.$id).'">Click Here</a>';
            $message_des = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message);
 
         $emaildata = ['email'=>$rmdata['email'],'data'=>$message_des,'subject'=>$emailSetting->title];
        sendMail('admin.emails.order',$emaildata);
        }
       
        if(!empty($orderData->user_email)){
              $emailSetting2 = EmailTamplate::where('category','rm_assign_users_email')->first();
               $message2 = !empty($emailSetting2->email_description) ? $emailSetting2->email_description : '' ;
            $message_des2 = str_replace(array('{#orderNo#}'), array( $orderData->order_no), $message2);
            
         $emaildata1 = ['email'=>$orderData->user_email,'data'=>$message_des2,'subject'=>$emailSetting2->title];
        sendMail('admin.emails.order',$emaildata1);
        }
	 return redirect('admin/order_edit/'.$request->order_id)->with('success','Rm Assign Successfully');
	}
	
	public function update_ca(Request $request){
	      $id = $request->order_id;
          $order = OrderDetail::where('id', $id)->update(['ca_user_id' => $request->ca,'ca_approval_status' => 0]);
       
        $cadata = User::find($request->ca);
       
		 $orderData = getorderData($id);
		  if(!empty($cadata['email'])){
		       $emailSetting = EmailTamplate::where('category','ca_assign')->first();
                 $message = !empty($emailSetting->email_description) ? $emailSetting->email_description : '' ;
                 $btn = '<a class="btn btn-warning text-white" href="'.url('admin/ca_view_order/'.$id).'">Click Here</a>';
            $message_des = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message);
 
         $emaildata = ['email'=>$cadata['email'],'data'=>$message_des,'subject'=>$emailSetting->title];
        sendMail('admin.emails.order',$emaildata);
        }
        
         $rmdata = User::find($orderData['rm_user_id']);
		  if(!empty($rmdata['email'])){
		       $emailSetting1 = EmailTamplate::where('category','ca_assign_rm_email')->first();
                 $message1 = !empty($emailSetting1->email_description) ? $emailSetting1->email_description : '' ;
                 $btn = '<a class="btn btn-warning text-white" href="'.url('admin/order_edit/'.$id).'">Click Here</a>';
            $message_des1 = str_replace(array('{#orderNo#}', '{#clickbutton#}'), array( $orderData->order_no, $btn), $message1);
 
         $emaildata = ['email'=>$rmdata['email'],'data'=>$message_des1,'subject'=>$emailSetting1->title];
        sendMail('admin.emails.order',$emaildata);
        }
        
        
        if(!empty($orderData->user_email)){
              $emailSetting2 = EmailTamplate::where('category','ca_assign_users_email')->first();
                 $message2 = !empty($emailSetting2->email_description) ? $emailSetting2->email_description : '' ;
            $message_des2 = str_replace(array('{#orderNo#}'), array( $orderData->order_no), $message2);
            
         $emaildata = ['email'=>$orderData->user_email,'data'=>$message_des2,'subject'=>$emailSetting2->title];
        sendMail('admin.emails.order',$emaildata);
        }
        
	 return redirect('admin/order_edit/'.$request->order_id)->with('success','Ca Assign Successfully');
	}
	
	
	
	
	
	 public function ca_payment(Request $request){
	      $data = 0;
	      $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id',
	      'services.status_id as status_id','users.name as user_name','users.email as user_email','status.name as status_name',
	      'invoice.private_comment','invoice.payment_status','invoice.invoice_status as invoice_status','invoice.invoice_number')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
          ->leftjoin('order_invoices as invoice','invoice.order_id','order_details.id')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.status',13)->where('order_details.ca_user_id',Auth::user()->id); 
         
         
      
        if($request->isMethod('post')){
         
        if($request->from_date!="" || $request->to_date!=""){        
           $data = $data->whereBetween('order_details.date', [$request->from_date, $request->to_date]);
        }
        if($request->service_id!="" ){     
           
           $data = $data->where('order_details.service_id',$request->service_id);
        }
        if($request->status_id!="" ){        
           $data = $data->where('order_details.status',$request->status_id);
        }
        if($request->order_id!="" ){        
           $data = $data->where('order_details.order_no',$request->order_id);
        }
        if($request->email!="" ){        
           $data = $data->where('users.email',$request->email);
        }
        if($request->mobile!="" ){        
           $data = $data->where('users.mobile',$request->mobile);
        }
        if($request->sp_share!="" ){        
           $data = $data->where('order_details.ca_share',$request->sp_share);
        }
        
       
        }
         $data = $data->orderBy('order_details.id','DESC')->get();
          //  dd($data);
		 return view('ca.payment',compact('data'));
		 
	 }
	 
	 
	 public function reimbursement_upload(Request $request){
	     if($request->amount > 0){
	                  $order = OrderDetail::find($request->order_id)->increment('reimbursement_amt',$request->amount);
	 }
	     $photo ='';
	     if($request->file('documents_file')){
            
                $image = $request->file('documents_file');
                $path = $image->getRealPath();      
                $photo =  $image->getClientOriginalName();
                $destinationPath = public_path('images/reimbursement_upload');
                $image->move($destinationPath, $photo);
             }
             
              $order_id = "";
             if(!empty($request->order_id)){
            $order_id = explode(',', $request->order_id);
             }
             foreach($order_id as $id){
                  $reimbursement = new OrderReimbursement;
                $reimbursement->order_id = $id;
                $reimbursement->user_id = $request->user_id;
                $reimbursement->amount = $request->amount;
                $reimbursement->srn_number = $request->srn_number;
                $reimbursement->files = $photo;
                $reimbursement->save(); 
             }
	           
                

    	 return redirect('admin/ca_payment')->with('success','Reimbursement Upload Successfully');

	 }
	 
	 public function download_reimbursement(Request $request,$id){
	 $data = OrderReimbursement::where('id', $id)->orderBy('id','DESC')->first();  
        $filepath = public_path('images/reimbursement_upload/').$data['files'];
      // $filepath = public_path('images/AdminLTELogo.png');
      return Response::download($filepath);
    }
    
    public function acknowledgement_all_view(Request $request){
   
          $data = OrderReimbursement::where('order_id', $request->order_id)->orderBy('id','DESC')->get();
            
		   $stateData ='';
        foreach($data as $item){
           $stateData.='
           
           
           <table style="width: 100%;">
  <tr>
    <th>Amount</th>
    <th>SRN Number</th>
    <th>Invoice Status</th>
  </tr>
  <tr>
    <td>'.$item->amount .'</td>
    <td>'.$item->srn_number.'</td>
    <td><a href="'.url('admin/downloadReimbursement/').'/'. $item->id. '">Download</a> </td>
  </tr>

</table>';
                            
           }
           echo $stateData;
	}
    
    
     public function download_DOCUMENTS(Request $request,$id){
        
	 $data = OrderRequiredDocuments::where('id', $id)->orderBy('id','DESC')->first();  
        $filepath = public_path('images/orderDocuments/').$data['files'];
      return Response::download($filepath);
    }
    
     public function Remove_DOCUMENTS(Request $request,$id){
         $orderData = OrderRequiredDocuments::where('id', $id)->orderBy('id','DESC')->first();  
         if(Auth::user()->role_id == 3 ){
             $data = OrderRequiredDocuments::where('id', $id)->delete();  
             	 return redirect('admin/ca_view_order/'.$orderData->order_id)->with('success','Order Required Documents Delete Successfully');
         }else{
              $data = OrderRequiredDocuments::where('id', $id)->delete();  
             	 return redirect('admin/order_edit/'.$orderData->order_id)->with('success','Order Required Documents Delete Successfully');
         }

    }
    
    	public function DoumentsSent(Request $request){
	      $id = $request->order_id;
	       $photo ='';
	     if($request->file('DoumentsSend')){
            
                $image = $request->file('DoumentsSend');
                $path = $image->getRealPath();      
                $photo =  $image->getClientOriginalName();
                $destinationPath = public_path('images/DoumentsSendToClient');
                $image->move($destinationPath, $photo);
             }
                 $documents = new OrderDocumentSendToClient;
    		     $documents->user_id = Auth::user()->id;
    		     $documents->order_id = $id;
    		     $documents->files = $photo;
    		     $documents->date = date('Y-m-d');
		         $documents->save();
       
    if(Auth::user()->role_id == 3 ){
             
             	 return redirect('admin/ca_view_order/'.$request->order_id)->with('success','Order Required Documents Delete Successfully');
         }else{
             
             	 return redirect('admin/order_edit/'.$request->order_id)->with('success','Order Required Documents Delete Successfully');
         }
	}
	
	
	public function downloadDoumentsSendByClient(Request $request,$id){
        
	 $data = OrderDocumentSendToClient::where('id', $id)->orderBy('id','DESC')->first();  
        $filepath = public_path('images/DoumentsSendToClient/').$data['files'];
      return Response::download($filepath);
    }
    
     public function admin_Remove_DoumentsSendByClient(Request $request,$id){
         $orderData = OrderDocumentSendToClient::where('id', $id)->orderBy('id','DESC')->first();  
         if(Auth::user()->role_id == 3 ){
             $data = OrderDocumentSendToClient::where('id', $id)->delete();  
             	 return redirect('admin/ca_view_order/'.$orderData->order_id)->with('success','Order Document Send To Client Delete Successfully');
         }else{
              $data = OrderDocumentSendToClient::where('id', $id)->delete();  
             	 return redirect('admin/order_edit/'.$orderData->order_id)->with('success','Order Document Send To Client Delete Successfully');
         }

    }
    
     public function invoice_upload(Request $request){
	    
	     $photo ='';
	     if($request->file('documents_file')){
            
                $image = $request->file('documents_file');
                $path = $image->getRealPath();      
                $photo =  $image->getClientOriginalName();
                $destinationPath = public_path('images/invoice_upload');
                $image->move($destinationPath, $photo);
             }
             
              $order_id = "";
             if(!empty($request->order_id)){
            $order_id = explode(',', $request->order_id);
             }
             foreach($order_id as $id){
                 $data = OrderInvoice::where('order_id',$id)->first();
                $data->order_id = $id;
               // $data->user_id = $request->user_id;
                $data->amount = $request->amount;
                $data->invoice_number = $request->invoice_number;
                $data->files = $photo;
                $data->save(); 
             }
	           
                

    	 return redirect('admin/ca_payment')->with('success','Invoice Upload Successfully');

	 }
	 
	  public function download_invoice(Request $request,$id){
        
	 $data = OrderInvoice::where('order_id',$id)->first();  
        $filepath = public_path('images/invoice_upload/').$data['files'];
      return Response::download($filepath);
    }
    
    
   
}