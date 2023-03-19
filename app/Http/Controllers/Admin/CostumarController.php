<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\User;
use File;
use App\Http\Requests\StoreCustomer;
use Image;
use Session;
    
class CostumarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
   $search['payment_status'] = $request->payment_status;
        $search['mobile'] = !empty($request->mobile) ? $request->mobile : ""; 
        $search['email'] = !empty($request->email) ? $request->email : ""; 
       
        $data = User::select('users.*','order_detail.payment_status')
                    ->leftjoin('order_details as order_detail','order_detail.user_id','users.id')->groupBy('order_detail.user_id')->where('users.role_id',5);
        
      
       	  if($request->isMethod('get')){

                     
                        if($request->payment_status >= "0"){
                             
                                $data = $data->where('order_detail.payment_status',$request->payment_status);
                            }
         
                       
                        if(!empty($request->email)){
                                $data = $data->where('users.email',$request->email);
                            }
       
                       
                        if(!empty($request->mobile)){
                                $data = $data->where('users.mobile',$request->mobile);
                            }
      
             
                        }
                        
                         $data =  $data->orderBy('id','DESC')->get();
                        
         return view('admin.costumar.index',compact('data','search'));
			
    }
		public function show(Request $request,$id){
        
	    $data = User::find($id);
       
         return view('admin.costumar.show',compact('data'));
			
    }
	public function create(Request $request){
	    
        return view('admin.costumar.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|unique:users,userName',
            'password' => 'required',
            'mobile' => 'required|unique:users,mobile',
            
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email',
        ]);
    
    
     if($request->file('profile')){
                 $image = $request->file('profile');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'profile';
                $image->move($destinationPath, $imageName);     
             } else{
			$imageName = '';
		}
				
        
        $role = User::create($request->all() + ['profile' => $imageName,'password' => Hash::make($request->password),'show_password' =>$request->password,'role_id' =>5]);
        $status = isset($request->status) ? 1 : 0;
        return redirect('admin/costumar')->with('success','Costumar created successfully');
    }
    
    
	public function edit(Request $request,$id){
        
		 $data = User::find($id);
        return view('admin.costumar.edit',compact('data'));
			
    }
    
    public function update(Request $request,$id)
    {
        $data = User::find($id);
        $this->validate($request, [
           'userName' => 'required|unique:users,userName,'.$id,
            'password' => 'required',
            'mobile' => 'required|unique:users,mobile,'.$id,
            
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            //'profile' => 'required'
        ]);
    
    
     if($request->file('profile')){
                 $image = $request->file('profile');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'profile';
                $image->move($destinationPath, $imageName);     
             } else{
			$imageName = '';
		}
				
        
        $data->update($request->all() + ['profile' => $imageName,'password' => Hash::make($request->password),'show_password' =>$request->password]);
        $status = isset($request->status) ? 1 : 0;
        return redirect('admin/costumar')->with('success','Costumar Update successfully');
    }
    
    
    
    public function destroy(Request $request)
    {
     $data = User::where('id', $request->user_id)->delete();
        return redirect('admin/costumar')->with('success','Costumar deleted successfully');
    }
    
    
    
      
    public function change_status(Request $request){
		          $FetchData = User::find($request->user_id);
		          $FetchData = User::where('id',$request->user_id)->update(['status'=>$request->status_name]);
       
            return redirect('admin/costumar')->with('success','Costumar status changed successfully');
        
		
        return view('admin.costumar.show');
			
    }
    
    // 	public function change_status(Request $request){
    //     if($request->status_name == 'Active'){
    //         $FetchData = User::find($request->user_id);
    //         $FetchData->update(['status'=>0]);
    //         return redirect('admin/costumar')->with('success','Costumar Active successfully');
    //     }else{
    //          $FetchData = User::find($request->user_id);
    //         $FetchData->update(['status'=>1]);
    //         return redirect('admin/costumar')->with('success','Costumar Inactive successfully');
    //     }
		
       
			
    // }
    
    
}