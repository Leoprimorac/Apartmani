<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    protected $fillable =[
        'name'
    ];

    public function prices()
    {
        return $this->hasMany(Prices::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function calendar()
    {
        return $this->hasMany(Calendar::class);
    }
    public function translation()
    {
        return $this->hasMany(Translation::class);
    }
}
