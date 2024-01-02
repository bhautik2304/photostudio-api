<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};

class covers extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->with('coverupgrades');
        });
    }

    protected $fillable = [
        'name',
        'type',
        'img',
    ];

    public function coverupgrades()
    {
        return $this->hasMany(coversupgrades::class, 'cover_id');
    }
}
