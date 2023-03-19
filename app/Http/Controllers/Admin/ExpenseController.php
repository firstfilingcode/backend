<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Expense;
use File;
use Image;
use Session;
    
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

        public function index(Request $request){
            
          $data = Expense::get();
                       
              
      
            return view('admin.expense.index',compact('data'));
            
        }
        
        public function create(Request $request){
            
            
            return view('admin.expense.create');
            
        }
        public function store(Request $request){
            
    
        $attachment = "";
        if($request->file('attachment')){
            
                $image = $request->file('attachment');
                $path = $image->getRealPath();      
                $attachment =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'expense';
                $image->move($destinationPath, $attachment);
             }
             
             
            $input = $request->all();
            $status = isset($request->status) ? 1 : 0;
            $input['status'] = $status;
            $input['attachment'] = $attachment;
           
             $expense = Expense::create($input);
       
        return redirect()->route('admin.expense.index')
                        ->with('success','expense created successfully');
            
            
        }
        
        public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Expense::find($request->expense_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/expense')->with('success','Expense Active successfully');
        }else{
             $FetchData = Expense::find($request->expense_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/expense')->with('success','Expense Inactive successfully');
        }
		
    }
    
    public function edit(Request $request, $id){    
        
	    $data = Expense::find($id);
	    
        return view('admin.expense.edit',compact('data'));
        
    }
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'expense_name' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'rate' => 'required',
            // 'attachment' => 'required',
            'total_amt' => 'required',
            
            
        ]);
        
        $attachment = "";
        if($request->file('attachment')){
            
                $image = $request->file('attachment');
                $path = $image->getRealPath();      
                $attachment =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'expense';
                $image->move($destinationPath, $attachment);
             }
        
        $expense = Expense::find($id);
        $input = $request->all();
        
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
         $expense->update($input);
         $expense->update(['attachment' => $attachment]);
         
         return redirect()->route('admin.expense.index')
                        ->with('success','expense updated successfully');
    }
    
    public function destroy(Request $request)
     {
   $delete = Expense::where('id', $request->expense_delete_id)->delete();
    return redirect()->route('admin.expense.index')
         ->withSuccess(__('Expense deleted successfully.'));
    }
   
    public function show(Request $request,$id){
        
        $data = Expense::find($id);
        
        return view('admin.expense.show',compact('data'));
    }    
   
   
}