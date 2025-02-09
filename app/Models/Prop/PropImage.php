<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class PropImage extends Model
{
    Protected $table = "prop_image";

    protected $fillable = [
        'prop_id',
        'image',
        
    ];

    public $timestamps = true;
    //
}
