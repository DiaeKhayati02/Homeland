<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;
use Illuminate\Support\Facades\Hash;

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
        

        return view('admins.edithometypes',compact('$HomeType'));
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
    
}
