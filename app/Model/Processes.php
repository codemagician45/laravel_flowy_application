<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Processes extends Model
{
    protected $fillable = [
        'name','description','sysnum','theme_id','fase_id','flowchart','block_data','role_data','long_des'
    ];
}
