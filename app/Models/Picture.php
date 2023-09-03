<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    
    protected $table='picture';

    public function customizedArt(){
        return $this->belongsTo(CustomizedArt::class);
    }
}
