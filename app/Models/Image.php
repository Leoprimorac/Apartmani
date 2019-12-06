<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'apartments_id', 'path'
    ];
    public function apartments() {
        return $this->belongsTo(Apartments::class);
    }
}
