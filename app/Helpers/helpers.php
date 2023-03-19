<?php	
	use Illuminate\Http\Request;
	use Illuminate\Support\Collection;
	use App\Models\User;
	use App\Models\PermissionManagement;
	use App\Models\Setting;
	use App\Models\Services;
	use App\Models\Customer;
	use App\Models\Sidebar;
	use App\Models\Branches;
	use App\Models\WebUser;	
	use App\Models\Role;
	use App\Models\Status;
	use App\Models\ServiceDetail;
	use App\Models\ServicesType;
	use App\Models\OrderDetail;
	use App\Models\DocType;
	use App\Models\ServiceDocuments;
	use App\Models\OrderRequiredDocuments;
	use App\Models\OrderDocumentSendToClient;
	use App\Models\ServiceSubType;
	use App\Models\ServiceTypesDropdown;
	use Spatie\Permission\Models\Permission;
	use Carbon\Carbon;
	use App\Models\OrderPriority;

	
	
	
	
	function setting(){
		$setting = Setting::first();
		return $setting;
	}
	
    function getSiderbar(){
       $getSidebar = Sidebar::orderBy('id', 'ASC')->get();
       return $getSidebar;
    }

    function getPermission(){
        $user_id = Auth::user()->id;
       
        $Permission = PermissionManagement::where('reg_user_id', $user_id)->get()->first();
       
     if( !empty($Permission) > 0){
         return $Permission; 
     }else{
          return redirect('admin/login')->with('success','CA created successfully');
     }
       
    }
   
	function responceStatusList(){
	
		return ResponceStatus::where('status','1')->pluck('name','id')->prepend('--Select--','');		
	}	

		
	function getServiceDetails(){
		$getServiceDetails = ServiceDetail::get();
		return $getServiceDetails;
	}
	function languages(){
		return Language::select('name','id','code')->where('status','1')->get();		
	}
	
	function rm(){
		return User::where('status','0')->where('role_id','2')->pluck('name','id')->prepend('--Select--','');		
	}
	

	

 	function customerDetails($id,$field){
 		$customerDetais = Customer::where('id',$id)->first();
 		if($customerDetais){
			return $customerDetais->$field;
		}else{
			return '';
		}
 	}


  	function branchDetails($id,$field){
 		$branchDetais = Branches::where('id',$id)->first();
 		if($branchDetais){
			return $branchDetais->$field;
		}else{
			return '';
		}
	}

// Function get differeance between two time


	// Get Coutry Name by ID
    function getCountryName($id){
		$countryNames  = DB::table('countries')->select('name')->where('id',$id)->get();
		foreach ($countryNames as $name)
		{
			$countryName = $name->name;
		}
		return $countryName;
    }

    function getStateName($id){

		$stateNames  = DB::table('countries')->select('name')->where('id',$id)->get();
		foreach ($stateNames as $name)
		{
			$stateName = $name->name;
		}
		return $stateName;    	
    	
    }	  
	
    function getRmUser(){
        $getRmUser = User::where('status','0')->where('role_id',2)->get();
        return $getRmUser;
    }
     function getCostumarUser(){
        $getCostumarUser = User::where('status','0')->where('role_id',5)->get();
        return $getCostumarUser;
    }
    function UserData($id){
        $getData = User::find($id);
        return $getData;
    }
     function user(){
        $getData = User::find(Auth::user()->id);
        return $getData;
    }
     
    function getCaUser(){
        $getCaUser = User::where('status','0')->where('role_id',3)->get();
        return $getCaUser;
    }
    
    function getRole(){
        $getRole = Role::orderBy('id','DESC')->get();
        return $getRole;
    }
     function getRoleName($id){
        $getRoleName = Role::find($id);
        return $getRoleName;
    }
    function getOrderPriority(){
        $getOrderPriority = OrderPriority::where('status','0')->get();
        return $getOrderPriority;
    }
    function sendMail($tmplale,$data) {

                Mail::send($tmplale, $data, function($message) use ($data) {
                    $message->from(getenv('MAIL_FROM_ADDRESS'));
                 $message->to($data['email']);
                 $message->subject($data['subject']);
               });
               
    }
     function invoiceSendMail($tmplale,$data) {

                Mail::send($tmplale, $data, function($message) use ($data) {
                    $message->from(getenv('MAIL_FROM_ADDRESS'));
                 $message->to($data['email']);
                 $message->subject($data['subject']);
                 $message->attach($data['invoice']);
                 
               });
               
    }
    
    
    function getService(){
      $service = Services::orderBy('id','DESC')->get();
      return $service;
    }
    
    function getStatus(){
      $Status = Status::where('status',0)->orderBy('id','ASC')->get();
      return $Status;
    }
    
    
    function getDocumentPadding($order_id){
        $doc = OrderRequiredDocuments::where('order_id',$order_id)->where('status',0)->orderBy('id','ASC')->get();
           return $doc;
    }
    function getDocument($order_id){
        $doc = OrderRequiredDocuments::where('order_id',$order_id)->orderBy('id','ASC')->get();
           return $doc;
    }
    function getDocumentUploadedByCustomer($order_id){
        $doc = OrderRequiredDocuments::where('order_id',$order_id)->where('status',1)->orderBy('id','ASC')->get();
           return $doc;
    }
       function getDoumentsSendByClient($order_id){
        $docs = OrderDocumentSendToClient::where('order_id',$order_id)->orderBy('id','DESC')->get();
           return $docs;
    }
    
     function getService_type(){
      $services_type = ServicesType::where('status',1)->orderBy('id','ASC')->get();
      return $services_type;
    }
    function getservice_type_dropdown(){
      $services_type_drp = ServiceTypesDropdown::where('status',0)->orderBy('id','ASC')->get();
      return $services_type_drp;
    }
    function getService_sub_type(){
      $services_sub_type = ServiceSubType::where('status',1)->orderBy('id','ASC')->get();
      return $services_sub_type;
    }
    
     function getService_type_status($id){
      if(!empty($id)){
            $ServicesType = ServicesType::find($id);
           
             $status_id = array();
            if($ServicesType['status_id'] > 0){ 
            $status_id = explode(',', $ServicesType['status_id']);
            }
            
        
            return $status_id;
            
        }
        
    }
      /*  
    function ActiveOrder($post){
       
        $post['form_date'] = !empty($post['form_date']) ? $post['form_date'] : "";
        $post['to_date'] = !empty($post['to_date']) ? $post['to_date'] : "";
        $post['service_id'] = !empty($post['service_id']) ? $post['service_id'] : "";
        $post['rm_user_id'] = !empty($post['rm_user_id']) ? $post['rm_user_id'] : "";
        $post['ca_user_id'] = !empty($post['ca_user_id']) ? $post['ca_user_id'] : "";
        $post['status_id'] = !empty($post['status_id']) ? $post['status_id'] : "";
        $post['order_id'] = !empty($post['order_id']) ? $post['order_id'] : "";
        $post['email'] = !empty($post['email']) ? $post['email'] : "";
        $post['mobile']= !empty($post['mobile']) ? $post['mobile'] : "";
        $post['sp_share'] =  !empty($post['sp_share']) ? $post['sp_share'] : "";
    $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.mobile as mobile','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')
         ->whereNotIn('order_details.status',[0,23,24]);
         
          if(Auth::user()->role_id == 2){
             
           $data = $data->where('order_details.rm_user_id', Auth::user()->id);
        }
        if($post['form_date'] !="" || $post['to_date'] !=""){        
           $data = $data->whereBetween('order_details.date', [$post['form_date'], $post['to_date']]);
        }
        if($post['service_id'] !="" ){     
           
           $data = $data->where('order_details.service_id',$post['service_id']);
        }
         if($post['ca_user_id']!="" ){     
           
           $data = $data->where('order_details.ca_user_id',$post['ca_user_id']);
        }
        if($post['rm_user_id'] !="" ){     
           
           $data = $data->where('order_details.rm_user_id',$post['rm_user_id']);
        }
        if($post['status_id']!="" ){        
           $data = $data->where('order_details.status',$post['status_id']);
        }
        if($post['order_id']!="" ){        
           $data = $data->where('order_details.order_no',$post['order_id']);
        }
        if($post['email']!="" ){        
           $data = $data->where('users.email',$post['email']);
        }
        if($post['mobile']!="" ){        
           $data = $data->where('users.mobile',$post['mobile']);
        }
        if($post['sp_share']!="" ){        
           $data = $data->where('order_details.ca_share',$post['sp_share']);
        }
        
        
        
         $data = $data->orderBy('order_details.id','DESC')->get();
        
       
      return $data;
    }
    
    
      function CaseHoldOrder($post){
      $post['form_date'] = !empty($post['form_date']) ? $post['form_date'] : "";
        $post['to_date'] = !empty($post['to_date']) ? $post['to_date'] : "";
        $post['service_id'] = !empty($post['service_id']) ? $post['service_id'] : "";
        $post['rm_user_id'] = !empty($post['rm_user_id']) ? $post['rm_user_id'] : "";
        $post['ca_user_id'] = !empty($post['ca_user_id']) ? $post['ca_user_id'] : "";
        $post['status_id'] = !empty($post['status_id']) ? $post['status_id'] : "";
        $post['order_id'] = !empty($post['order_id']) ? $post['order_id'] : "";
        $post['email'] = !empty($post['email']) ? $post['email'] : "";
        $post['mobile']= !empty($post['mobile']) ? $post['mobile'] : "";
        $post['sp_share'] =  !empty($post['sp_share']) ? $post['sp_share'] : "";
    $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.mobile as mobile','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')
         ->where('order_details.status',23);
         
          if(Auth::user()->role_id == 2){
             
           $data = $data->where('order_details.rm_user_id', Auth::user()->id);
        }
        if($post['form_date'] !="" || $post['to_date'] !=""){        
           $data = $data->whereBetween('order_details.date', [$post['form_date'], $post['to_date']]);
        }
        if($post['service_id'] !="" ){     
           
           $data = $data->where('order_details.service_id',$post['service_id']);
        }
         if($post['ca_user_id']!="" ){     
           
           $data = $data->where('order_details.ca_user_id',$post['ca_user_id']);
        }
        if($post['rm_user_id'] !="" ){     
           
           $data = $data->where('order_details.rm_user_id',$post['rm_user_id']);
        }
        if($post['status_id']!="" ){        
           $data = $data->where('order_details.status',$post['status_id']);
        }
        if($post['order_id']!="" ){        
           $data = $data->where('order_details.order_no',$post['order_id']);
        }
        if($post['email']!="" ){        
           $data = $data->where('users.email',$post['email']);
        }
        if($post['mobile']!="" ){        
           $data = $data->where('users.mobile',$post['mobile']);
        }
        if($post['sp_share']!="" ){        
           $data = $data->where('order_details.ca_share',$post['sp_share']);
        }
        
        
        
         $data = $data->orderBy('order_details.id','DESC')->get();
        
       
      return $data;
    }
    
     function WorkDoneOrder($post){
         $post['form_date'] = !empty($post['form_date']) ? $post['form_date'] : "";
        $post['to_date'] = !empty($post['to_date']) ? $post['to_date'] : "";
        $post['service_id'] = !empty($post['service_id']) ? $post['service_id'] : "";
        $post['rm_user_id'] = !empty($post['rm_user_id']) ? $post['rm_user_id'] : "";
        $post['ca_user_id'] = !empty($post['ca_user_id']) ? $post['ca_user_id'] : "";
        $post['status_id'] = !empty($post['status_id']) ? $post['status_id'] : "";
        $post['order_id'] = !empty($post['order_id']) ? $post['order_id'] : "";
        $post['email'] = !empty($post['email']) ? $post['email'] : "";
        $post['mobile']= !empty($post['mobile']) ? $post['mobile'] : "";
        $post['sp_share'] =  !empty($post['sp_share']) ? $post['sp_share'] : "";
    $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.mobile as mobile','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')
         ->where('order_details.status',24);
         
          if(Auth::user()->role_id == 2){
             
           $data = $data->where('order_details.rm_user_id', Auth::user()->id);
        }
        if($post['form_date'] !="" || $post['to_date'] !=""){        
           $data = $data->whereBetween('order_details.date', [$post['form_date'], $post['to_date']]);
        }
        if($post['service_id'] !="" ){     
           
           $data = $data->where('order_details.service_id',$post['service_id']);
        }
         if($post['ca_user_id']!="" ){     
           
           $data = $data->where('order_details.ca_user_id',$post['ca_user_id']);
        }
        
        if(!empty($post['rm_user_id'])){     
        
           $data = $data->where('order_details.rm_user_id',$post['rm_user_id']);
        }
        if($post['status_id']!="" ){        
           $data = $data->where('order_details.status',$post['status_id']);
        }
        if($post['order_id']!="" ){        
           $data = $data->where('order_details.order_no',$post['order_id']);
        }
        if($post['email']!="" ){        
           $data = $data->where('users.email',$post['email']);
        }
        if($post['mobile']!="" ){        
           $data = $data->where('users.mobile',$post['mobile']);
        }
        if($post['sp_share']!="" ){        
           $data = $data->where('order_details.ca_share',$post['sp_share']);
        }
        
        
        
         $data = $data->orderBy('order_details.id','DESC')->get();
        
       
      return $data;
    }*/
    
    
    
    function getorderData($id){
      $data = OrderDetail::select('order_details.*','services.name as service_name','services.status_id as status_id','services.service_type_id as service_type_id','users.name as user_name','users.email as user_email','status.name as status_name')
                 ->leftjoin('users','users.id','order_details.user_id')
                 ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
                 ->leftjoin('status','status.id','order_details.status')
                 ->leftjoin('services','services.id','service_details.service_id')->where('order_details.id',$id)
                 ->get()->first();
      return $data;
    }
?>