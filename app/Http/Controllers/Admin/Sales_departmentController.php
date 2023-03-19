<?php
    
namespace App\Http\Controllers\Admin; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sales_department;
use DB;
    
class Sales_departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
     	$data = Sales_department::orderBy('id','DESC')->get();
      
    return view('admin.sales_department.index',compact('data'));
			
    }
    public function create(){
        return view('admin.sales_department.create');
    }
    
   public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sales_departments,name'
            
        ]);
    
        $sales_department = Sales_department::create($request->all());
        return redirect('admin/sales_department')->with('success','Sales Department created successfully');
    }
    
    
    public function edit($id){
        
         $data = Sales_department::find($id);
        return view('admin.sales_department.edit',compact('data'));
    }
    
     public function update(Request $request,$id)
    {
        $data = Sales_department::find($id);
        $this->validate($request, [
           'name' => 'required'
            
        ]);
    
    
    
			//dd($request);	
        
        $data->update($request->all());
        return redirect('admin/sales_department')->with('success','Sales Department Update successfully');
    }
    
    public function destroy($id)
    {
		
        $delete = Sales_department::where('id', $id)->delete();
        return redirect('admin/sales_department')->with('success','Sales Department deleted successfully');
         return redirect()->route('admin/sales_department')
         ->withSuccess(__('Sales Department deleted successfully.'));
    }
    
    public function show($slug)
    {
      $test = Test::whereSlug($slug)->firstOrFail();
      return view('tests.show', compact('test'));
    }
}