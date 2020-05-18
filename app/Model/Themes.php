<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    //
    protected $fillable = [
        'name','description','sysnum','fase_id'
    ];
}
