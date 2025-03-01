<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;
use App\Models\Prop\AllRequest;
use App\Models\Prop\PropImage;
use Illuminate\Support\Facades\Hash;
use File;
class AdminsController extends Controller
{
    public function viewLogin() {
        return view('admins.login');
    }

    public function checkLogin(Request $request) {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index() {

        $adminsCount = Admin::select()->count();
        $propsCount = Property::select()->count();
        $hometypesCount = HomeType::select()->count();

        return view('admins.index', compact('adminsCount','propsCount','hometypesCount'));
    }
    public function allAdmins() {

        $allAdmins = Admin::select()->get();
        

        return view('admins.admins', compact('allAdmins'));
    }

    public function createAdmins() {

        
        

        return view('admins.createadmins');
    }
    public function storeAdmins(Request $request)
    {
        Request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:40',
            'password' => 'required|max:40',
        ]);
        $storeAdmins = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($storeAdmins) {
            return redirect()->route('admin/all-admins')->with('success', 'Admin created successfully');
        }
    }

    public function allHomeTypes() {

        $allHomeTypes = HomeType::select()->get();
        

        return view('admins.hometypes',compact('allHomeTypes'));
    }
    public function createHomeTypes() {

        $allHomeTypes = HomeType::select()->get();
        

        return view('admins.createhometypes');
    }
    public function storeHomeTypes(Request $request)
    {
        Request()->validate([
            'hometypes' => 'required|max:40',
        ]);
        $storeHomeTypes = HomeType::create([
            'hometypes' => $request->hometypes,
        ]);

        if($storeHomeTypes) {
            return redirect()->route('admin/all-hometypes')->with('success', 'Home type created successfully');
        }
    }

    public function editHomeTypes($id) {

        $HomeType = HomeType::find($id);
        

        return view('admins.edithometypes',compact('HomeType'));
    }
    public function updateHomeTypes(Request $request, $id)
    {
        Request()->validate([
            'hometypes' => 'required|max:40',
        ]);
        $singleHomeType = HomeType::find($id);
        $singleHomeType->update($request->all());

        if($singleHomeType) {
            return redirect()->route('admin/all-hometypes/')->with('update', 'Home type updated successfully');
        }
    }
    public function deleteHomeTypes($id) {

        $HomeType = HomeType::find($id);
        $HomeType->delete();

        if($HomeType) {
            return redirect()->route('admin/all-hometypes/')->with('delete', 'Home type deleted successfully');
        }
    }

    public function Requests() {

        $requests = AllRequest::all();
        

        return view('admins.requests',compact('requests'));
    }
    
    public function allProps() {

        $props = Property::all();
        

        return view('admins.props',compact('props'));
    }

    public function createProps() {

        
        $allProps = Property::all();
        return view('admins.createprops', compact('allProps'));
    }

    public function storeProps(Request $request)
    {
        // Request()->validate([
        //     'hometypes' => 'required|max:40',
        // ]);
        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $storeProps = Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $request->image,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'sq_ft' => $request->sq_ft,
            'year_built' => $request->year_built,
            'location' => $request->location,
            'home_type' => $request->home_type,
            'type' => $request->type,
            'city' => $request->city,
            'more_info' => $request->more_info,
            'agent_name' => $request->agent_name,
        ]);

        if($storeProps) {
            return redirect()->route('admin/all-props')->with('success', 'Property created successfully');
        }
    }

    public function createGallery() {

        

        return view('admins.creategallery');
    }
    public function storeGallery(Request $request) {

        

           //     'filenames' => 'required',
        //     'filenames.*' => 'image'
        // ]);

        $files = [];
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $file)
            {
                $path = "assets/images_gallery/";

                $name = time().rand(1,50).'.'.$file->extension();
                $file->move(public_path($path), $name);  
                $files[] = $name; 
                
                PropImage::create([
                    "image" => $name,
                    "prop_id" => $request->prop_id,
                ]);
                
            }
        }

        // $file= new PropImage();
        // $file->filenames = $files;
        // $file->save();

        if($name) {

            return redirect('/admin/all-props/')->with('success_gallery', 'Gallery added successfully');

        }
    }

    public function deleteProps($id) {

        
        $deleteProp = Property::find($id);
        if(File::exists(public_path('assets/images/' . $deleteProp->image))){
            File::delete(public_path('assets/images/' . $deleteProp->image));
        }else{
            //dd('File does not exists.');
        }
        $deleteProp->delete();

        $deleteGallery = PropImage::where('prop_id', $id)->get();
        foreach($deleteGallery as $gallery) {
            if(File::exists(public_path('assets/images_gallery/' . $gallery->image))){
                File::delete(public_path('assets/images_gallery/' . $gallery->image));
            }else{
                //dd('File does not exists.');
            }
            $gallery->delete();
        }

        if($name) {

            return redirect('/admin/all-props/')->with('delete', 'Property deleted successfully');

        }
    }
    
}
