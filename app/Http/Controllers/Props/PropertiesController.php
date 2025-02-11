<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
class PropertiesController extends Controller
{
    public function index() {

        $props = Property::select()->take(9)->orderBy('created_at','desc')->get();
        return view('home', compact('props'));
        }


    public function single($id) {

            $singleProp = Property::find($id);

            $propImages = PropImage::where('prop_id', $id)->get();

            $relatedProps = Property::where('home_type', $singleProp->home_type)
            ->where('id','!=', $id)
            ->take(3)
            ->orderBy('created_at','desc')
            ->get();
            return view('props.single', compact('singleProp','propImages','relatedProps'));
            }
}
