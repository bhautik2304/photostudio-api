<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};

class productcoverprice extends Model
{
    use HasFactory;


    protected static function booted(): void
    {
        static::addGlobalScope('currencyscop', function (Builder $builder) {
            $builder->with(['currency']);
        });
    }

    public function currency()
    {
    return $this->belongsTo(countryzone::class, 'countryzone_id', 'id');
    }
}
