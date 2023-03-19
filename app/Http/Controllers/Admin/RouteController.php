<?php    
namespace App\Http\Controllers\Admin;    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Route;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
use App\Http\Requests\StoreCoupon;
use Image;
class RouteController extends Controller

{
    public function index()
    {
         $data = Route::select('routes.*','service_types.name as service_types','service_sub_type.name as service_sub_type')
                            ->leftJoin('service_types as service_types','routes.service_type_id','service_types.id')
                            ->leftJoin('service_sub_types as service_sub_type','routes.service_sub_type_id','service_sub_type.id')->orderBy('routes.order_By','ASC')->get();;
       
         return view('admin.route.index',compact('data'));
    }
    
    public function create()
    {
        return view('admin.statues.create');
    }
    
  
    
     
    
   

    	public function edit(Request $request,$id){
          $data = Route::find($id);
        return view('admin.route.edit',compact('data'));
			
    }
        
     public function update(Request $request, $id)
    {
       

        $this->validate($request, [
            'route' => 'required',
            'page_name' => 'required',
           
        ]);
        $blog = Route::find($id);
        $input = $request->all();
         $blog->update($input);

          return redirect()->route('admin.routes.index')
                        ->with('success','Route updated successfully');
    }
    
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Status::find($request->news_letters_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/order_status')->with('success','status Active successfully');
        }else{
             $FetchData = Status::find($request->news_letters_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/order_status')->with('success','status Inactive successfully');
        }
		
    }
    
    
         public function destroy(Request $request)
     {
   $delete = Route::where('id', $request->routes_delete_id)->delete();
    return redirect()->route('admin.routes.index')
         ->with('success','Routes deleted successfully.');
}
      
}

