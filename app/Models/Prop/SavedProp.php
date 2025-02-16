<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedProp extends Model
{
    use HasFactory;
    Protected $table = "savedprops";

    protected $fillable = [
        'prop_id',
        'user_id',
        'title',
        'image',
        'location',
        'price'
        
    ];

    public $timestamps = true;
    //
}
