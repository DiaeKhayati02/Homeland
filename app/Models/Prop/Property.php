<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{

    use HasFactory;
    Protected $table = "props";

    protected $fillable = [
        'title',
        'price',
        'image',
        'beds',
        'baths',
        'sq_ft',
        'home_type',
        'year_built',
        'price_sqft',
        'more_info',
        'location',
        'agent_name',

    ];

    public $timestamps = true;

    //
}
