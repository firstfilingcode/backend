<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\EmailTamplate;
use File;
use Image;
use Session;
    
class EmailTemplateController extends Controller
{
    
    public function create(Request $request){
	    
	    
        return view('admin.email_template.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
         
           
        ]);
    
        
        $input = $request->all();
       
      
        $tamplate = EmailTamplate::create($input);
        
       
        return redirect()->route('admin.templete_view.index')
                        ->with('success','tamplates created successfully');
    }
    
    public function index(Request $request){
	    
	    $data = EmailTamplate::Select('email_tamplates.*')->get();
	    
        return view('admin.email_template.index',compact('data'));
        
    }
   
    
    public function edit(Request $request, $id){    
        
	    $data = EmailTamplate::find($id);
	    
        return view('admin.email_template.edit',compact('data'));
        
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        
           
        ]);
        $tamplate = EmailTamplate::find($id);
        $input = $request->all();
      
        
        $tamplate->update($input);
        
         return redirect()->route('admin.templete_view.index')
                        ->with('success','tamplate updated successfully');
    }
    
    
     public function destroy(Request $request)
{
   $delete = EmailTamplate::where('id', $request->emailtemplate_dalete_id)->delete();
    return redirect()->route('admin.templete_view.index') ->withSuccess(__('tamplate deleted successfully.'));
}
}