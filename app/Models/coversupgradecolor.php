<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};

class coversupgradecolor extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'cover_id',
        'coversupgrades_id',
        'img',
        'colorcode'
    ];
}
