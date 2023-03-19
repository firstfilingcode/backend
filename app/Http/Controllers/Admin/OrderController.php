<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\OrderInvoice;
use App\Models\Services;
use App\Models\ServiceDetail;
use App\Models\Chat;
use App\Models\OrderRequiredDocuments;
use App\Models\DocType;
use App\Models\OrderReimbursement;
use App\Models\OrderRemoveDocuments;
use App\Models\User;
use App\Models\ServiceDocuments;
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
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function index(Request $request){
        $data = 0;
         $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','services.status_id as status_id','users.mobile as mobile','users.name as name','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.payment_status',1);
          if(Auth::user()->role_id == 2){
           
           $data = $data->where('order_details.rm_user_id', Auth::user()->id);
        }
        
        
        if($request->isMethod('post')){
            
        if($request->tab_type == "awaiting_acceptance"){        
           $data = $data->where('order_details.status',1);
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
        
        
        }
         $data = $data->orderBy('order_details.id','DESC')->get();
      
         return view('admin.order.index',compact('data'));
     }
     
   public function pending_order(Request $request){
        $data = 0;
         $data = OrderDetail::select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','services.status_id as status_id','users.mobile as mobile','users.name as name','users.email as user_email','status.name as status_name')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.payment_status',0);
          if(Auth::user()->role_id == 2){
           
           $data = $data->where('order_details.rm_user_id', Auth::user()->id);
        }
        
        
        if($request->isMethod('post')){
            
        if($request->tab_type == "awaiting_acceptance"){        
           $data = $data->where('order_details.status',1);
        }
        
        if($request->tab_type == "active_order"){        
           $data = $data->whereIn('order_details.status',[2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]);
        }
        if($request->tab_type == "Caseonhold"){        
           $data = $data->where('order_details.CaseOnHold',"no");
        }
        if($request->tab_type == "workdone"){        
           $data = $data->where('order_details.status',24);
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
        
        
        }
         $data = $data->orderBy('order_details.id','DESC')->get();
      
         return view('admin.order.pending_order',compact('data'));
     }
     
     
     public function order_edit(Request $request,$id){
         
        $data = OrderDetail::select('order_details.*','services.name as service_name','service_details.short_des as service_covered','services.status_id as status_id','services.service_type_id as service_type_id','users.email as user_email','users.mobile as user_mobile')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.id',$id)->get()->first();
         
         if(Auth::user()->role_id == 1){
            $order = OrderDetail::where('id', $id)->update(['admin_new_order' => 0]);
         }else{
             $order = OrderDetail::where('id', $id)->update(['rm_new_order' => 0]);
         }

         return view('admin.order.show',compact('data'));
     }
     
      public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('admin.order.index')
                        ->with('success','order deleted successfully');
    }
    
    
    
     public function payment(Request $request){
	      $data = 0;
	      $data = OrderDetail::select('order_details.*','services.name as service_name','services.status_id as status_id','services.service_type_id as service_type_id','users.name as user_name','users.email as user_email','status.name as status_name',
	      'invoice.invoice_status','invoice.payment_status','invoice.private_comment')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('status','status.id','order_details.status')
         ->leftjoin('services','services.id','service_details.service_id')
         ->leftjoin('order_invoices as invoice','invoice.order_id','order_details.id')->where('order_details.status',13); 
        
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
        if($request->invoice_status!="" ){   
               
           $data = $data->where('invoice.invoice_status',$request->invoice_status);
        }
         if($request->payment_status!="" ){  
        
           $data = $data->where('invoice.payment_status',$request->payment_status);
        }
       
        }
         $data = $data->orderBy('order_details.id','DESC')->get();
          
		 return view('admin.order.payment',compact('data'));
		 
	 }
    
    public function news_letter(Request $request){
         return view('admin.emails.news_letter');
    }
    public function invoice_status(Request $request){
          if($request->isMethod('post')){
             $invoice_number =  OrderInvoice::where('order_id',$request->order_id)->first(['invoice_number']);
             //dd($allinvoic->invoice_number);
           $data = OrderInvoice::where('invoice_number',$invoice_number)->update(['invoice_status'=>$request->invoice_status]);
          return redirect()->route('admin.payment')
                        ->with('success','Status Changed');
              
          }
         
    }
    public function payment_status(Request $request){
          if($request->isMethod('post')){
             $data = OrderInvoice::where('order_id',$request->order_id)->update(['payment_status'=>$request->payment_status]);
           return redirect()->route('admin.payment')
                        ->with('success','Status Changed');
              
          }
        
    }
    public function private_comment(Request $request){
          if($request->isMethod('post')){
             $data = OrderInvoice::where('order_id',$request->order_id)->update(['private_comment'=>$request->private_comment]);
           return redirect()->route('admin.payment')
                        ->with('success','Status Changed');
              
          }
        
    }
    
    
     
    public function order_details(Request $request,$id){
           
        if(!empty($id)){
        $headermenu = array();      
         
            $headermenu = ServiceDetail::where('service_id',$id)->get();
            
            $Data ='<option value="">Select</option>';
            foreach($headermenu as $category){
            $Data.='
            <option value="'.$category->id.'">'.$category->category.'/'.$category->price.'</option>';
            }
            echo $Data;
            
        } 
    } 
    
    
        public function headerSubtypeData(Request $request,$id){
      
        if(!empty($id)){
        $headerSubMenu = array();      
         
            $headerSubMenu = ServiceDetail::where('service_id',$id)->get();
            
            $subCategoryData ='<option value="">Select</option>';
            foreach($headerSubMenu as $subCategory){
            $subCategoryData.='
            <option value="'.$subCategory->id.'">'.$subCategory->category.'</option>';
            }
            echo $subCategoryData;
            
        } 
    } 
    
     public function order_add(Request $request){
        
             if($request->isMethod('post')){
            
           $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                
                // shuffle the result
                $string = str_shuffle($pin);
        
		     $user = User::where('id',Auth::user()->id)->first();
		    
		     $serviceDetail = ServiceDetail::where('id',$request->service_detail_id)->first();
	        $service = Services::find($request->service_id);
		             $order_detail = new OrderDetail;
        		     $order_detail->user_id = !empty($request->user_id) ? $request->user_id : $user->id;
        		     $order_detail->transaction_no = '';
        		     $order_detail->order_no = $string;
        		     $order_detail->service_detail_id = $serviceDetail->id;
        		     $order_detail->service_id = $serviceDetail->service_id;
        		     $order_detail->amount = !empty($request->amount) ? $request->amount : $serviceDetail->price;
        		     $order_detail->payment_mode = $request->payment_mode;
        		     $order_detail->payment_status = 1;
        		     $order_detail->ca_share = $service['ca_share'];
        		     $order_detail->coupon_id = $request->coupon_id;
        		     $order_detail->coupon_discount = $request->coupon_discount;
        		     $order_detail->coupon_code = $request->coupon_code;
        		     $total = (!empty($request->amount) ? $request->amount : $serviceDetail->price)-((!empty($request->amount) ? $request->amount : $serviceDetail->price)*$request->coupon_discount/100);
        		     //$order_detail->total_amount = $total + $total*18/100;
        		     $order_detail->total_amount = $total;
        		     $order_detail->date = date('Y-m-d');
        		     $order_detail->save();
        		     $order_detail_id = $order_detail->id;
        		     
        		     $emailData = ['email'=>$user->email, 'subject' => 'Order Purchased Successfully']; 
                     $data = sendMail('admin.emails.order_purchased',$emailData);
		     
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
               return redirect()->route('admin.order')
                        ->with('success','Status Changed');
            
             }
         return view('admin.order.add');

       
    }
    
    public function remove_DOCUMENTS(Request $request,$id){
                 $orderData = OrderRequiredDocuments::where('id', $id)->orderBy('id','DESC')->first();  
        
        
                 $remove_documents = new OrderRemoveDocuments;
    		     $remove_documents->user_id = Auth::user()->id;
    		     $remove_documents->order_id = $orderData->order_id;
    		     $remove_documents->files = $orderData->files;
    		     $remove_documents->date = date('Y-m-d');
		         $remove_documents->save();
		         
                 $data = OrderRequiredDocuments::where('id', $id)->update(['files' =>null,'status'=>0]);
             	 return redirect('admin/order_edit/'.$orderData->order_id)->with('success','Order Remove Documents  Successfully');

    }
    
     public function CaseOnHold(Request $request){
       $id = $request->order_id;
        $order = OrderDetail::where('id', $id)->update(['CaseOnHold' => $request->CaseOnHold]);
		   
          return response()->json(['status'=>true,'message'=>'Case On Hold Update successfully'],200 );
	}
    
     public function update_old_status(Request $request){
       $id = $request->order_id;

               $status_id = null;

       if(!empty($request->status_id)){
     
                       $status_id = implode(',', $request->status_id);
   
       
       }

        $order = OrderDetail::where('id', $id)->update(['old_status' => $status_id,'status' => $request->status_id[count($request->status_id)-1]]);
         return redirect('admin/order_edit/'.$request->order_id)->with('success','Order Reopen  Successfully');
	}
    
}
