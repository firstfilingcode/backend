<?php    
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Route;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
    
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function index(Request $request)
    {
        
         $data = Faq::all();
             
		 return view('admin.faq.index',compact('data'));
    }
    
    
    public function create(Request $request)
    {
        $routes = Route::orderBy('id')->get();
		 return view('admin.faq.create',compact('routes'));
    }
    
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'page_name' => 'required',
        ]);
   
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['page_name'] = $request->page_name;
        $faq = Faq::create($input);
       
        return redirect()->route('admin.faq.index')
                        ->with('success','Faq created successfully');
    }
    
   
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Faq::find($request->faq_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/faq')->with('success','Faq Active successfully');
        }else{
             $FetchData = Faq::find($request->faq_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/faq')->with('success','Faq Inactive successfully');
        }
		
    }
    
    public function edit(Request $request, $id){    
        
	    $data = Faq::find($id);
	    $routes = Route::orderBy('id')->get();
        return view('admin.faq.edit',compact('data','routes'));
        
    }
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'page_name' => 'required',
        ]);
        
        $faq = Faq::find($id);
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status; 
        $faq->update($input);
         return redirect()->route('admin.faq.index')
                        ->with('success','Faq updated successfully');
    }
    
     public function destroy(Request $request)
{
   $delete = Faq::where('id', $request->faq_dalete_id)->delete();
    return redirect()->route('admin.faq.index')
         ->withSuccess(__('Faq deleted successfully.'));
}
    
}