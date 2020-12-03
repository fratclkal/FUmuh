<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fastaccess extends Model
{
    use HasFactory;

    protected $table = 'fast_access';
    protected $guarded = [
        'id'
    ];
}
