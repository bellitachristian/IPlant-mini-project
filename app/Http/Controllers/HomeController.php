<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Plant;
use App\Models\Photo;
use App\Models\Post;
use DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array(
            'post' => Plant::where('status','posted')->get(),
            'posted'=>Plant::where('status','posted')->count(),
        );
        return view('User.home',$data);
    }
    public function admin_dash()
    {
        $data = array(
            'LoggedUserAdmin' =>User::where('id','=',session('LoggedUserAdmin'))->first(), 
            'plants'=>Plant::all()->count(),
            'posted'=>Plant::where('status','posted')->count(),
            'users'=>User::where('name','!=','Admin')->count(),
            'tanom'=>Plant::all(),
            'post'=>Plant::where('status','posted')->get(),
            'user'=>User::where('name','!=','Admin')->get(),
          );
        return view('Admin.admin',$data);
    }
    public function viewplants()
    {
        $admin=User::where('id','=',session('LoggedUserAdmin'))->first();
        $data = array(
            'LoggedUserAdmin' =>User::where('id','=',session('LoggedUserAdmin'))->first(), 
            'plants'=> Plant::all(),
          );
          return view('Admin.Plant.plantmanagement',$data);
    }
    
    public function plantsave(Request $req){
        $plant = new Plant;
        if($req->hasfile('photo')){
            $file = $req->file('photo');
            $extention =$file->getClientOriginalExtension();
            $filename =time().'.'.$extention;
            $file->move('uploads/plants/',$filename);
            $plant->photo = $filename;      
        }
        $plant->plant_name = $req->name;
        $plant->description = $req->desc;
        $plant->guide = $req->guide;
        $plant->save();
        return redirect()->back()->with('status','Plant Added Successfully');
    }

    public function plantdelete($id){
        $plant = Plant::find($id);
        $destination = 'uploads/plants/'.$plant->photo;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $plant->delete();
        return redirect()->back()->with('status','Plant Removed Successfully');
    }

    public function editviewplant($id){
        $data = array(
            'LoggedUserAdmin' =>User::where('id','=',session('LoggedUserAdmin'))->first(), 
            'plants'=> Plant::find($id),
          );
          return view('Admin.Plant.Editplant',$data);
    }

    public function plantedit(Request $req, $id){
     
            $plant = Plant::find($id);
            if($req->hasfile('photo')){
                $destination = 'uploads/plants/'.$plant->photo;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $req->file('photo');
                $extention =$file->getClientOriginalExtension();
                $filename =time().'.'.$extention;
                $file->move('uploads/plants/',$filename);
                $plant->photo = $filename;      
            }
            $plant->plant_name = $req->name;
            $plant->description = $req->description;
            $plant->guide = $req->guide;
            $plant->update();
            return redirect()->back()->with('status','Plant Updated Successfully');            
    }
    public function viewpost(){
        $data = array(
            'LoggedUserAdmin' =>User::where('id','=',session('LoggedUserAdmin'))->first(), 
            'plants'=> Plant::where('status','not posted')->get(),
          );
          return view('Admin.Plant.Post Plant.createpost',$data);
    }
    public function postcreate($id){
        $data =array(
            'LoggedUserAdmin' =>User::where('id','=',session('LoggedUserAdmin'))->first(), 
            'plants'=> Plant::find($id),
        );
        return view('Admin.Plant.Post Plant.uploadpost',$data);
    }

    function uploadphotopost(Request $req,$id){
        $image = $req->file('file');
        $photo = array();
        $photo[] = $image;
        $name = array();

        foreach ($photo as $pics) {
            $image_name = md5(rand(1000,10000));
            $ext = strtolower($image->getClientOriginalExtension());
            $imageName = $image_name.'.' .$ext;
    
            $image->move(public_path('uploads/post'), $imageName);
            $name[] = $imageName;
            $imageupload = new Photo; 
            $imageupload->imagename= $imageName;
            $imageupload->plant_id = $id;
            $imageupload->save();  
        }        
    }

    function postsave($id){
        $checkpost = Post::all()->where('plant_id',$id)->count();
        if($checkpost == 0){
            $post = new Post;
            $post->plant_id = $id;
            $post->save(); 
        }
        $plants = Plant::find($id);
        $plants->status = "posted"; 
        $plants->update();
    }

    function fetchpostphotos($id)
    {
     $multiple = Photo::all()->where('plant_id',$id);   
     $output = '<div class="row">';
     foreach($multiple as $image)
     {
      $output .= '
      <div class="col-md-3" style="margin-bottom:16px;" align="center">
                <div style="display:flex">
                    <img style="width:200px; height:150px; padding:3px" src="'.asset('uploads/post/' . $image->imagename).'"/>
                    <button style="margin-top:1%" type="button" class="btn btn-secondary remove_image" id="'.$image->imagename.'">Remove</button>
                </div>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    function deletepostphotos(Request $req)
    {
        $imagephoto = $req->get('name');
        DB::table('photos')->where('imagename', $req->get('name'))->delete();
        $destination = 'uploads/post/'.$req->get('name');
            if(File::exists($destination)){ 
                File::delete($destination);
            }   
    }

    function fetch()
    {
     $plant =User::where('id','=',session('LoggedUserAdmin'))->first();
     $multiple = DB::select("select *from photos");   
     $output = '<div class="row">';
     foreach($multiple as $image)
     {
      $output .= '
      <div class="col-md-3" style="margin-bottom:16px;" align="center">
                <img src="'.asset('uploads/animal-shelter/uploaded-photos/' . $image->imagename).'" class="img-thumbnail" width="200" height="150" style="height:200px;" />
                <button style="margin-top:1%" type="button" class="btn btn-secondary remove_image" id="'.$image->imagename.'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    public function postupdate($id){
        $data =array(
            'LoggedUserAdmin'=>User::where('id','=',session('LoggedUserAdmin'))->first(),
            'plants'=>Plant::find($id),
        );
        return view('Admin.Plant.Post Plant.updatepost',$data);
    }

    function post_delete($id){
        $post = Post::find($id);
        $plant = Plant::where('id',$post->plant_id)->first();
        $photos = Photo::all()->where('plant_id',$plant->id);

        $plant->status = "not posted";
        $plant->update();

        DB::table('photos')->where('plant_id',$plant->id)->delete();
        foreach($photos as $photo){
        $destination = 'uploads/post/'.$photo->imagename;
            if(File::exists($destination)){ 
                File::delete($destination);
            }   
        }
        $post->delete();
     }

    public function plant_details($id){
        $data =array(
            'plants'=>Plant::find($id),
        );
        return view('User.viewplant',$data);
    }

    public function loadpost(){
        $post = Plant::where('status','posted')->get();
        $output = ' <main style ="margin-top:30px" class="grid-new1">';    
            foreach($post as $posts)
            {
            $posted = new Carbon($posts->updated_at);
            $output .= '
            <article>
            <div class="col-sm">
                <div class="card shadow mb-4">
                    <div class="card-header">';
                        if($posts->status == "posted"){
                        $output .= '
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> </label></span>
                            </a> 
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="#" style="text-decoration:none"><button style="text-decoration:none" class="dropdown-item" value="'.$posts->id.'" id="edit">Edit</button></a>
                                    ';
                                        $deletepost = Post::where('plant_id',$posts->id)->first(); $output .= '
                                    <a style="text-decoration:none" href="#"><button style="text-decoration:none" class="dropdown-item" value="'.$deletepost->id.'" id="remove">Remove</button></a>
                                </div> 
                            <label>&nbsp &nbsp<i style="color:green; font-size:12px" class="fa fa-circle"></i> '.$posts->status.'</label><span><label style="float:right"> posted '.$posted->diffForHumans(). ' &nbsp 
                        </div>      
                        ';
                        }
                        $output .= '    
                    </div>
                    <div style="background-color:whitesmoke" class="card-body">
                        <div style="display:flex">
                            <div style="margin:0" class="col-sm">
                                <div style="background-color:">
                                <img style="padding:10px;" src="'.asset('uploads/plants/' . $posts->photo).'" width="100%" height="100%" alt="">
                                </div>    
                            </div>  
                            <div class="col-sm"> 
                                <div style="display:flex">';
                                    foreach($posts->photos as $pics){
                                        $output .= '
                                        <div class="col-sm"> 
                                        <img src="'.asset('uploads/post/'.$pics->imagename).'" width="100%" height="100%" alt="">
                                        </div>
                                        ';
                                    }   
                                    $output .= '    
                                </div>
                                <div class="col-sm">
                                <h5 style="text-transform:uppercase;margin-top:10px;text-align:center; color:black; font-weight:bold">"All about '.$posts->plant_name.'"</h5>
                                <p style="text-indent:30px;color:black; text-align:justify">'.$posts->description.'</p> <hr>
                                </div>
                            </div>
                        </div>
                            <div>
                                <div style="background-color:#fff; display:flex">
                                    
                                    <div class="col-sm">
                                        <h5 style="text-transform:uppercase; text-align:center;color:black;font-weight:bold"">"Planting Guide"</h5>
                                        <p style="text-indent:30px;padding-top:5px; text-align:justify">'.$posts->guide.'</p> <hr>
                                    </div>
                                </div>  
                            </div>  
                    </div> 
                    <div class="card-header">

                    </div>
                </div>
            </div>
            </article>
            ';
            }
        if(empty($posts)){
            $output.='
            <div> 
            <h6>No Post exist!</h6>
            </div>
           ';
         }
        
        $output .= '</div>';
        echo $output;        
     }
    
}
