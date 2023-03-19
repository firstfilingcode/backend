<?php    
namespace App\Http\Controllers;    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageMap;

use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
use Carbon\Carbon;

    
class AjaxController extends Controller
{
    
	 public function deleteAll(Request $request)
    {		
        $map_id = $request->map_id;
        $package_id = $request->package_id;
        DB::table('package_maps')->where('map_id',$map_id)->where('package_id',$package_id)->delete();       
        return response()->json(['success'=>"User Deleted successfully."]);
    }
    
}