<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['nama', 'slug'];

    protected static function booted(): void
    {
        static::creating(fn ($c) => $c->slug = $c->slug ?: Str::slug($c->nama));
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
