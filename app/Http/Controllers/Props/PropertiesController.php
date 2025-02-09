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

            $prop_images = PropImage::where('prop_id', $id)->get();

            return view('props.single', compact('singleProp','propImages'));
            }
}
