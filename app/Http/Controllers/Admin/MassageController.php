<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\Massage;
use File;
use App\Http\Requests\StoreCustomer;
use Image;
use Session;
    
class MassageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(){
          $roles = Role::where('name', '!=','Admin')->pluck('name','name')->all();
         
        return view('admin.massage.create',compact('roles'));
    }
    
    public function index(){
        return view('admin.massage.index');
    }
    
    
}