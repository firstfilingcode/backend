<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\WalletSettings;
use File;
use Image;
use Session;
use Redirect;
    
class WalletsettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function wallet_settings(Request $request){
        
         $data = WalletSettings::all();
        
         return view('admin.wallet_settings.wallet_settings',compact('data'));
     }
     
     
     public function wallet_settings_edit(Request $request,$id){
            
            $data = WalletSettings::find($id);
          
          
           if($request->isMethod('post')){

            
       		    $data->user_use_by=$request->user_use_by;
    			$data->save();
    			
    			
    			return redirect::to('admin/wallet_settings')->with('message', 'Slide Update Successfully.');
    		
        }
        return view('admin.wallet_settings.wallet_settings_edit',['data'=>$data]);
    }
     

}
