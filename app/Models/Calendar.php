<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable =[
        'apartments_id', 'date_start', 'date_end', 'availability'
    ];

    public function apartments()
    {
        return $this->belongsTo(Apartments::class);
    }
}
