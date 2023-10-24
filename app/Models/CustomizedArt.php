<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedArt extends Model
{
    use HasFactory;
    
    protected $table='customized__art';

    public function pictures(){
        return $this->hasMany(Picture::class);
    }
    public function frames(){
        return $this->hasMany(Frame::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
