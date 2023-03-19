<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Contacts;
use File;
use Image;
use Session;
    
class ContactContainer extends Controller
{

    public function index(Request $request){
         $data = Contacts::all();
        return view('admin.contacts.index',compact('data'));
        
    }
 
}