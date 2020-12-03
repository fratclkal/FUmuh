<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $guarded = [
        'id'
    ];
    function sub_menu(){
        return $this->hasMany('App\Models\Submenu','menu_id','id');
    }
}
