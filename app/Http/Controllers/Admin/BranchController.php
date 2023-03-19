<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Branch;
use File;
use Image;
use Session;
    
class BranchController extends Controller
{
    public function create(Request $request){
	    
	    
        return view('admin.branch.create');
        
    }
    
    public function index(Request $request){
         $data = Branch::all();
        return view('admin.branch.index',compact('data'));
        
    }
      public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
           'owner_name' => 'required',
            'branch_code' => 'required',
            'gst_no' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
           // 'contrary_id' => 'required',
            //'state_id' => 'required',
            //'city_id' => 'required',
            //'address' => 'required',
            //'pin_code' => 'required',
           
        ]);
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $blog = Branch::create($input);
       
        return redirect()->route('admin.branch.index')
                        ->with('success','Branch created successfully');
    }
    
     public function show(Request $request,$id){
        
        $data = Branch::all();
        
        return view('admin.branch.show',compact('data'));
    }
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Branch::find($request->branch_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/branch')->with('success','slider Active successfully');
        }else{
             $FetchData = Branch::find($request->branch_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/branch')->with('success','slider Inactive successfully');
        }
		
    }
    
     public function edit(Request $request, $id){    
        
	    $data = Branch::find($id);
	    
        return view('admin.branch.edit',compact('data'));
        
    }
    
     public function update(Request $request, $id)
    {
        $this->validate($request, [
           /*'name' => 'required',
           'honer_name' => 'required',
            'branch_code' => 'required',
            'gst_no' => 'required|gst_no',
            'mobile_no' => 'required',
            'email' => 'required|email',*/
        ]);
        $branch = Branch::find($id);
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $branch->update($input);
         return redirect()->route('admin.branch.index')
                        ->with('success','Branch updated successfully');
    }
    
      public function destroy(Request $request)
     {
   $delete = Branch::where('id', $request->branch_delete_id)->delete();
    return redirect()->route('admin.branch.index')->withSuccess(__('Branch deleted successfully.'));
}
}