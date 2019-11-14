<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $fillable =[
        'date_start', 'date_end', 'price', 'apartments_id'
    ];

    public function apartments()
    {
        return $this->belongsTo(Apartments::class);
    }
}
