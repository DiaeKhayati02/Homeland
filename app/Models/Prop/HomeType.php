<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    use HasFactory;
 
    Protected $table = "hometypes";

    protected $fillable = [
        'id',
        'hometypes',
        

    ];

    public $timestamps = true;
    //
}
