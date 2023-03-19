<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\ServicesType;

use File;
use Image;

use Session;
    
class TypeserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $data = ServicesType::orderBy('id','DESC')->get();
      
      
         return view('admin.typeservice.index',compact('data'));
			
    }
    
   
   
    
    
   
}