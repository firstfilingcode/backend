<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\NewsLetter;
use File;
use Image;
use Session;
    
class NewsLettersController extends Controller
{
    public function index(Request $request){
	    
	    $data = NewsLetter::orderBy('id','DESC')->get();
	    
        return view('admin.news_letters.index',compact('data'));
        
    }
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = NewsLetter::find($request->news_letters_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/news_letters')->with('success','NewsLater Active successfully');
        }else{
             $FetchData = NewsLetter::find($request->news_letters_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/news_letters')->with('success','NewsLater Inactive successfully');
        }
		
    }
    
}