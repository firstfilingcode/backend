<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Calender;
use File;
use Image;
use Session;
    
class CalendarController extends Controller
{
    
    public function create(Request $request){
	    
	    
        return view('admin.calendar.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'color_code' => 'required',
           
            
            
        ]);
        
        $input = $request->all();
       
      
        $tamplate = Calender::create($input);
        
       
        return redirect()->route('admin.calendar.index')
                        ->with('success','Calendar created successfully');
    }
    
    public function index(Request $request){
	    
	    $data = Calender::orderBy('id','DESC')->get();
	    
        return view('admin.calendar.index',compact('data'));
        
    }
   
    
    public function edit(Request $request, $id){    
        
	    $data = Calender::find($id);
	    
        return view('admin.calendar.edit',compact('data'));
        
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
         'name' => 'required',
            'color_code' => 'required',
           
        ]);
        $tamplate = Calender::find($id);
        $input = $request->all();
      
        
        $tamplate->update($input);
        
         return redirect()->route('admin.calendar.index')
                        ->with('success','Calendar updated successfully');
    }
    
    
     public function destroy(Request $request)
{
   $delete = Calender::where('id', $request->calendar_id)->delete();
    return redirect()->route('admin.calendar.index')->with('success','Calendar deleted successfully');
}

 public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Calender::find($request->calendar_id);
            $FetchData->update(['status'=>0]);
             return redirect()->route('admin.calendar.index')->with('success','calendar Inactive successfully'); 
        }else{
             $FetchData = Calender::find($request->calendar_id);
            $FetchData->update(['status'=>1]);
             return redirect()->route('admin.calendar.index')->with('success','calendar Active successfully');
        }
		
    }
}