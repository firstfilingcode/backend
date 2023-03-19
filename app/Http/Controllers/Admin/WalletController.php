<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Wallet;
use App\Models\WalletDetail;
use File;
use Image;
use Session;
    
class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function index(Request $request){
         $data = Wallet::with('userData')->orderBy('id','DESC')->get();
         return view('admin.wallet.index',compact('data'));
     }
     
     public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Wallet::find($request->wallet_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/wallet')->with('success','wallet Active successfully');
        }else{
             $FetchData = Wallet::find($request->wallet_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/wallet')->with('success','wallet Inactive successfully');
        }
     }
     
     public function show(Request $request,$id){
         
        $data = WalletDetail::with('userData')->where('wallet_id',$id)->orderBy('id','DESC')->get();
        
         return view('admin.wallet.show',compact('data'));
     }
}
