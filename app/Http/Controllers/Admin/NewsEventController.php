<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\NewsEvent;
use File;
use Image;
use Session;
    
class NewsEventController extends Controller
{
    
    public function create(Request $request){
	    
	    
        return view('admin.news_events.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'title' => 'required',
            'time' => 'required',
            'event_description' => 'required',
            'date' => 'required',
           
        ]);
    
        
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
      
        $NewsEvent = NewsEvent::create($input);
        
       
        return redirect()->route('admin.news_events.index')
                        ->with('success','NewsEvents created successfully');
    }
    
    public function index(Request $request){
	    
	    $data = NewsEvent::all();
	    
        return view('admin.news_events.index',compact('data'));
        
    }
    
    public function change_status(Request $request){
        
        if($request->status_name == 'Active'){
            $FetchData = NewsEvent::find($request->news_events_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/news_events')->with('success','NewsEvents Active successfully');
        }else{
             $FetchData = NewsEvent::find($request->news_events_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/news_events')->with('success','NewsEvents Inactive successfully');
        }
		
    }
    
    
    public function edit(Request $request, $id){    
        
	    $data = NewsEvent::find($id);
	    
        return view('admin.news_events.edit',compact('data'));
        
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'title' => 'required',
            'time' => 'required',
            'event_description' => 'required',
            'date' => 'required',
           
        ]);
        $NewsEvent = NewsEvent::find($id);
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        
        $NewsEvent->update($input);
        
         return redirect()->route('admin.news_events.index')
                        ->with('success','NewsEvent updated successfully');
    }
    
    
     public function destroy(Request $request)
{
   $delete = NewsEvent::where('id', $request->newsevents_dalete_id)->delete();
    return redirect()->route('admin.news_events.index') ->withSuccess(__('NewsEvent deleted successfully.'));
}
}