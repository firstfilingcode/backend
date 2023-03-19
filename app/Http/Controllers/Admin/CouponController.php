<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Coupon;
use App\Models\Route;
use App\Models\Services;
use File;
use Image;
use Session;
use Auth;
class CouponController extends Controller
{
    public function create(Request $request){
        $service = Services :: orderBy('id')->get();
        return view('admin.coupon.create',compact('service'));
        
    }
    
    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
           'coupon_code' => 'required',
           'discount_percent' => 'required',
           
        ]);
        

/*  $data = array (
    "id_number" => $request->name,
 
); 
$jsonData = json_encode($data);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.surepass.io/api/v1/aadhaar-validation/aadhaar-validation',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$jsonData,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY3NjQ0NjEwNiwianRpIjoiY2NmYjM3OWEtNGU4NS00ZGZhLTg0MTItNzA0MzZlOTA0YzYzIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmZpcnN0ZmlsaW5nQHN1cmVwYXNzLmlvIiwibmJmIjoxNjc2NDQ2MTA2LCJleHAiOjE2NzczMTAxMDYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ1c2VyIl19fQ.zyYhGctEZ58mH5xKIk-YcQltyvlcUlV2sSMLsdfIwj4'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo print_r($response);die;*/

        $input = $request->all();
        $status = isset($request->status) ? 0 : 1;
        $input['status'] = $status;
        $input['user_id'] = Auth::user()->id;
        $coupon = Coupon::create($input);
        return redirect()->route('admin.coupon.index')
                        ->with('success','coupon created successfully');
    }
       
    
    public function index(Request $request){
        
       $data = Coupon::select('coupons.*','service.name as service_name')
         ->leftjoin('services as service','service.id','coupons.service_id')->orderBy('coupons.id','DESC')->get();
         
        
        return view('admin.coupon.index',compact('data'));
        
    }
    
    public function edit(Request $request ,$id){
        $service = Services :: orderBy('id')->get();
         $data = Coupon::find($id);
         
        return view('admin.coupon.edit',compact('data','service'));
        
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'coupon_code' => 'required',
            'discount_percent' => 'required',
        ]);
        $user = Coupon::find($id);
        $input = $request->all();
        $status = isset($request->status) ? 0 : 1;
        $input['status'] = $status;
        $input['user_id'] = Auth::user()->id;
        
        $user->update($input);
        return redirect()->route('admin.coupon.index')
                        ->with('success','Coupon updated successfully');
                        
                        
    }
    
 
    	public function change_status(Request $request){
		          $FetchData = Coupon::find($request->user_id);
		          $FetchData = Coupon::where('id',$request->user_id)->update(['status'=>$request->status_name]);
       
            return redirect('admin/coupon')->with('success','Coupon status changed successfully');
        
		
			
    }
    
    
     public function destroy(Request $request)
     {
     $delete = Coupon::where('id', $request->coupon_delete_id)->delete();
    return redirect()->route('admin.coupon.index')->withSuccess(__('Coupon deleted successfully.'));
     }
    
    public function show(Request $request,$id){
        
        $data = Coupon::first();  
        
        return view('admin.coupon.show',compact('data'));
    }
    
}