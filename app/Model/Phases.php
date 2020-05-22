<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Phases extends Model
{
    //
    protected $fillable=[
        'name','description','sysnum','user_id','acive'
    ];
}
