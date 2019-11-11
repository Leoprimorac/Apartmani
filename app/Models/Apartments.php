<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    protected $fillable =[
        'name', 'description', 'details', 'amenities'
    ];
    public function prices()
    {
        return $this->belongsTo(Prices::class);
    }
}
