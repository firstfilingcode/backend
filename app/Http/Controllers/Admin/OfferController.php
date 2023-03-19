<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Offer;
use File;
use Image;
use Session;
    
class OfferController extends Controller
{
    public function create(Request $request){
        return view('admin.offer.create');
        
    }
    
    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'promo_code' => 'required',
           // 'photo' => 'required',
        ]);
    $photo = "";
        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'offer';
                $image->move($destinationPath, $photo);
             }
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['photo'] = $photo;
        $offer = Offer::create($input);
       
        return redirect()->route('admin.offer.index')
                        ->with('success','offer created successfully');
    }
       
    
    public function index(Request $request){
        
       $data = Offer::all();
       
        if($request->from_date!="" || $request->to_date!=""){        
           $data = Offer::whereBetween('from_date', [$request->from_date, $request->to_date])
                             ->orWhereBetween('to_date', [$request->from_date, $request->to_date])->get();
        }     
        
        return view('admin.offer.index',compact('data'));
        
    }
    
    public function edit(Request $request ,$id){
        
         $data = Offer::find($id);
         
        return view('admin.offer.edit',compact('data'));
        
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'promo_code' => 'required',
        ]);
        $user = Offer::find($id);
        $input = $request->all();
        
         $photo = "";
         if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'offer';
                $image->move($destinationPath, $photo);
              }
         
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        
        
        $user->update($input);
         $user->update(['photo' => $photo]);
        return redirect()->route('admin.offer.index')
                        ->with('success','Offer updated successfully');
                        
                        
    }

    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Offer::find($request->offer_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/offer')->with('success','Offer Active successfully');
        }else{
             $FetchData = Offer::find($request->offer_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/offer')->with('success','Offer Inactive successfully');
        }
			
    }
    
    public function destroy(Request $request)
     {
   $delete = Offer::where('id', $request->offer_delete_id)->delete();
    return redirect()->route('admin.offer.index')
         ->withSuccess(__('Offer deleted successfully.'));
}
    
    public function show(Request $request,$id){
        
        $data = Offer::find($id);
        
        return view('admin.offer.show',compact('data'));
    }
    
}