<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable =[
        'description', 'details', 'language', 'apartments_id'
    ];

    public function apartments() {
        return $this->belongsTo(Apartments::class);
    }
}
