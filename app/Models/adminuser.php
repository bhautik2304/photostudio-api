<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminuser extends Model
{
    use HasFactory;

    protected $fillable = [
        "role",
        "name",
        "phone_no",
        "email",
        "password",
        "token",
        "avatar",
        "email_veryfi",
        "phone_veryfi",
    ];
}
