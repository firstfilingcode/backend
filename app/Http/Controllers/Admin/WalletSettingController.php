<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\WalletSetting;
use App\Models\User;
use File;
use Image;
use Session;
    
class WalletSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function index(Request $request){
         $data = WalletSetting::orderBy('id','DESC')->get();
         return view('admin.wallet_setting.index',compact('data'));
     }
     

     
     public function edit(Request $request,$id){
         
        $data = WalletSetting ::find($id);
        
         return view('admin.wallet_setting.edit',compact('data'));
     }
     
      public function update(Request $request,$id)
    {
       
        $this->validate($request, [
            'refer_to_amount' => 'required',
            'refer_form_amount' => 'required',
        ]);
        $blog = WalletSetting::find($id);
        $input = $request->all();
        
       $blog->update($input);

         return redirect()->route('admin.wallet_settings.index')
                        ->with('success','Referral Setting  successfully');
    }
}
