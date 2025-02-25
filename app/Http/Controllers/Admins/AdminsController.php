<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Prop\Property;
use App\Models\Prop\HomeType;

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
}
