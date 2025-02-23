<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\AllRequest;
use App\Models\Prop\SavedProp;
use Auth;

class UsersController extends Controller
{
    public function allRequests() {
        if(auth()->user()) {
            $allRequests = AllRequest::where('user_id', Auth::user()->id)->get();
        return view('users.displayrequests', compact('allRequests'));
        } else {
            return redirect()->route('login');
            
        }
        
    }
    public function allSavedProps() {
        if(auth()->user()) {
        $allSavedProps = SavedProp::where('user_id', Auth::user()->id)->get();
        return view('users.displaysavedprops', compact('allSavedProps'));
        } else {
            return redirect()->route('login');
        }
}
}