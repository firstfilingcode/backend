<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Role;
use App\Models\PermissionManagement;
use App\Models\UserDocument;
use DB;
use Hash;
use Helper;
use Auth;
use Session;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
      public function index(Request $request)
    {
       
        	$query = User::select('users.*','roles.name as role')
        	->leftjoin('roles','roles.id','users.role_id');
	/*	$query = User::where('id', '!=',1);*/

        if($request->role_id!=""){		
           $query->where('role_id',$request->role_id);
        }
        if($request->status!=""){     
           $query->Where('users.status',$request->status);
        }   		
		
   		$data = $query->orderBy('id','DESC')->get();
   		
        return view('admin.users.index',compact('data'))
            ;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=','Admin')->pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
           'password' => 'required',
           'role_id' => 'required',
            'mobile' => 'required|min:10|numeric'
        ]);

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
		        $status = isset($request->status) ? 0 : 1;

		$user = new User;
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
    if($request->role_id == 3){
        $user->ca_share_pass = $request->password;
    }
        $user->status = $status;
        $user->save(); 
        $user_id = $user->id;
        
        $user_doc = new UserDocument;
        $user_doc->user_id = $user_id;
        $user_doc->branch_id = 1;
        $user_doc->aadhar_image = $aadharName;
        $user_doc->cpo_certificate = $cpo_certificate;
        $user_doc->membership_certificate = $membership_certificate;
        $user_doc->role_id = $request->role_id;
        $user_doc->aadhar_no = $request->aadhar_no;
		$user_doc->save(); 
		
		
        $permis = new PermissionManagement;
        $permis->user_id = Auth::user()->id;
        $permis->branch_id = 1;
        $permis->reg_user_id = $user_id;
        if(!empty($request->sidebar_id)){
            $permis->sidebar_id =$sidebar_id;
        }
        if(!empty($request->sub_menu_id)){
            $permis->sub_menu_id =$sub_menu_id;
        }
		$permis->save();     
		
    $role= Role ::find('id');
	
        if(!empty($request->email)){
         $emaildata = ['email'=>$request->email, 'role'=>$request->role_id,'userName'=>$request->email,'show_password'=>$request->password,'dob'=>$request->dob,'mobile'=>$request->mobile,'name'=>$request->name, 'subject'=>'Registration Successful !'];

        
        sendMail('admin.emails.user',$emaildata,$role);
        }
        
                if($request->role_id == 1){
                     return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');
                        
                    }else if($request->role_id == 2){
                      return redirect()->route('admin.rm.index')
                        ->with('success','RM created successfully');

                    
                    }else if($request->role_id == 3){
                      return redirect()->route('admin.ca.index')
                        ->with('success','CA created successfully');

                    
                    }else if($request->role_id == 4){
                      return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');

                   
                    }else if($request->role_id == 5){
                      return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');

                    }
                   
                    
        
        return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $permission = PermissionManagement::where('reg_user_id',$id)->get()->first();
      
        return view('admin.users.edit',compact('user','permission'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $user->ca_share_pass = $request->password;
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
    
        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request)
     {
   $delete = User::where('id', $request->user_delete_id)->delete();
    return redirect()->route('admin.users.index')->withSuccess(__('Users deleted successfully.'));
}
		public function change_password(Request $request){
			
			$id = Auth::id();			
			$user = User::find($id);			 
			if(!empty( $request->except('_token') ) ){			
				
				$this->validate($request, [			
				'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
				'password_confirmation' => 'min:6'
				]);

				
				$user = User::find($id);
				$request->merge(["password"=>bcrypt($request->new_password)]);
				$user->update($request->all());
				
				return redirect()->route('admin.users.change_password')->with('success','Change password successfully');
				}else{		
				return view('admin.users.change_password',compact('user'));
			}
		}
		
		public function change_status(Request $request){
		          $FetchData = User::find($request->user_id);
		          $FetchData = User::where('id',$request->user_id)->update(['status'=>$request->status_name]);
       
            return redirect('admin/users')->with('success','Users status changed successfully');
        
		
        return view('admin.users.show');
			
    }
    
	/*public function change_statuses(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = User::find($request->click_permission);
            $FetchData->update(['click_permission'=>0]);
            return redirect('admin/users')->with('success','Profile Active successfully');
        }else{
             $FetchData = User::find($request->click_permission);
            $FetchData->update(['click_permission'=>1]);
            return redirect('admin/users')->with('success','Profile Inactive successfully');
        }
        
    }*/
    
    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $photo = "";
        if($request->file('inputPhoto')){
            
                $image = $request->file('inputPhoto');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'profile';
                $image->move($destinationPath, $photo);
             }
             
             
        $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        $attach = User::find($id);
		$attach->update(['photo' => $photo]);
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
        }   
        
     public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('admin.users.profile')->with('profile',$profile);
    }
    
    public function ca_permission(Request $request){
			
			$id = Auth::id();			
			$user = User::find($id);			 
			if(!empty( $request->except('_token') ) ){			
				
				

				$user = User::find($id);
				$input = $request->all();
				$user['ca_share_pass'] = $request->ca_share_pass;
				$status = isset($request->click_permission) ? 1 : 0;
                $user['click_permission'] = $status;
				$user->save();
			
			   return redirect('admin/home')->with('success','Ca Share password Changed successfully');
				}else{		
				return view('admin.users.ca_permission',compact('user'));
			}
		}
	
	public function logout(Request $request) {
          Auth::logout();
          return redirect('admin/login');
        }
        
        
        
        public function userSidePer(Request $request){
       
       if(!empty($request->role_id)){
           $sidebar_id = Role::where('id',$request->role_id)->pluck('sidebar_id')->first();
       }else{
            $sidebar_id = Role::where('id',$request->user_Sub_side_per)->pluck('sub_menu_id')->first();
       }
       
        
        
        echo $sidebar_id;
    }  
}