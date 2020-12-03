<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $table = 'sub_menu';
    protected $guarded = [
        'id'
    ];
    function menu(){
        return $this->belongsTo('App\Models\Menu','menu_id','id');
    }
}
