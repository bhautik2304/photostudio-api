<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};

class product extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('cover', function (Builder $builder) {
            $builder->with('orientation');
        });
    }

    protected $fillable = [
        'name',
        'img',
        'min_page'
    ];

    public function orientation()
    {
        return $this->hasMany(productorientation::class, 'product_id');
    }
}
