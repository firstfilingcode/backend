<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Blog;
use File;
use Image;
use Session;
    
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   public function create(Request $request){
	    
	    
        return view('admin.blog.create');
        
    }
    
  public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
           // 'photo' => 'required',
        ]);
    $photo = "";
        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'blog';
                $image->move($destinationPath, $photo);
             }
             
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['photo'] = $photo;
        $input['category'] = $request->category;
        $blog = Blog::create($input);
       
        return redirect()->route('admin.blog.index')
                        ->with('success','Blog created successfully');
    }
    
    public function index(Request $request){
        
	    $data = Blog::all();
	    
        return view('admin.blog.index',compact('data'));
        
    }
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Blog::find($request->blog_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/blog')->with('success','slider Active successfully');
        }else{
             $FetchData = Blog::find($request->blog_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/blog')->with('success','slider Inactive successfully');
        }
		
    }
    
    public function show(Request $request,$id){
        
        $data = Blog::all();
        
        return view('admin.blog.show',compact('data'));
    }
    public function edit(Request $request, $id){    
        
	    $data = Blog::find($id);
	    
        return view('admin.blog.edit',compact('data'));
        
    }
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
        ]);
        $blog = Blog::find($id);
        $input = $request->all();
        
        
     $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
         $blog->update($input);
         if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'blog';
                $image->move($destinationPath, $photo);
                
                 $blog->update(['photo' => $photo]);
              }
         return redirect()->route('admin.blog.index')
                        ->with('success','Blog updated successfully');
    }
    
    
     public function destroy(Request $request)
     {
   $delete = Blog::where('id', $request->blog_delete_id)->delete();
    return redirect()->route('admin.blog.index')
         ->withSuccess(__('Blog deleted successfully.'));
}
    
   
}