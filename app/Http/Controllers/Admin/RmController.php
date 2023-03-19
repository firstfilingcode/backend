<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\PermissionManagement;
use Auth;;
use File;
use App\Http\Requests\StoreCustomer;
use Image;
use Session;
    
class RmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
	$data = User::where('role_id',2)->orderBy('id','DESC')->get();
       
         return view('admin.rm.index',compact('data'));
			
    }
    
    public function show(Request $request,$id){
        
	    $data = User::find($id);
       
         return view('admin.rm.show',compact('data'));
			
    }
	
	public function create(Request $request){
	    
        return view('admin.rm.create');
        
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
            'address' => 'required',
            
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
				
        
        $role = User::create($request->all() + ['profile' => $imageName,'password' => Hash::make($request->password),'show_password' =>$request->password,'role_id' =>3]);
        return redirect('admin/rm')->with('success','RM created successfully');
    }
    
    
  public function edit($id)
    {
        $user = User::find($id);
        $permission = PermissionManagement::where('reg_user_id',$id)->get()->first();
     
        return view('admin.rm.edit',compact('user','permission'));
    }
    
   public function update(Request $request, $id)
    {
        
            $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'role_id' => 'required',
            'mobile' => 'required|min:10|numeric'
        ]);
 $user = User::find($id);
        if(!empty($request->sidebar_id)){
             $sidebar_id = implode(',', $request->sidebar_id);
        }
        if(!empty($request->sub_menu_id)){
             $sub_menu_id = implode(',', $request->sub_menu_id);
        }
        if($request->file('profile')){
                 $image = $request->file('profile');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'profile';
                $image->move($destinationPath, $imageName);     
             }else{
			$imageName = '';
		}
		if($request->file('aadhar_image')){
                 $image = $request->file('aadhar_image');
                $path = $image->getRealPath();      
                $aadharName =  $image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'aadhar_image';
                $image->move($destinationPath, $aadharName);     
             }else{
			$aadharName = '';
		}
		
		if($request->file('cpo_certificate')){
                 $image = $request->file('cpo_certificate');
                $path = $image->getRealPath();      
                $cpo_certificate =  $image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'cpo_certificate';
                $image->move($destinationPath, $cpo_certificate);     
             }else{
			$cpo_certificate = '';
		}
			if($request->file('membership_certificate')){
                 $image = $request->file('membership_certificate');
                $path = $image->getRealPath();      
                $membership_certificate =  $image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'membership_certificate';
                $image->move($destinationPath, $membership_certificate);     
             } else{
			$membership_certificate = '';
		}
        $status = isset($request->status) ? 1 : 0;
        $user->profile = $imageName;
        $user->userName = $request->email;
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->show_password = $request->password;
        $user->status = $status;
        $user->save(); 

        $user_doc = UserDocument::where('user_id',$id)->get()->first();
        if(!empty($user_doc)){
            $user_doc = $user_doc;
        }else{
              $user_doc = new UserDocument;

        }
        $user_doc->user_id = $id;
        $user_doc->branch_id = 1;
        $user_doc->aadhar_image = $aadharName;
        $user_doc->cpo_certificate = $cpo_certificate;
        $user_doc->membership_certificate = $membership_certificate;
        $user_doc->role_id = $request->role_id;
        $user_doc->aadhar_no = $request->aadhar_no;
		$user_doc->save(); 

		$permis = PermissionManagement::where('reg_user_id',$id)->get()->first();
        if(!empty($permis)){
            $permis = $permis;
        }else{
              $permis = new PermissionManagement;

        }
        $permis->user_id = Auth::user()->id;
        $permis->branch_id = 1;
        $permis->reg_user_id = $id;
        if(!empty($request->sidebar_id)){
            $permis->sidebar_id =$sidebar_id;
        }
        if(!empty($request->sub_menu_id)){
            $permis->sub_menu_id =$sub_menu_id;
        }
		$permis->save(); 
   
        return redirect()->route('admin.rm.index')
                        ->with('success','Rm updated successfully');
    }
    
    
    
    public function destroy(Request $request)
    {
	
        User::where('id', $request->user_id)->delete();
        return redirect('admin/rm')->with('success','RM deleted successfully');
    }
    
    	public function change_status(Request $request){
		          $FetchData = User::where('id',$request->user_id1)->update(['status'=>$request->status_name]);
       
            return redirect('admin/rm')->with('success','RM status changed successfully');
        
		
       
			
    }
    	   
}