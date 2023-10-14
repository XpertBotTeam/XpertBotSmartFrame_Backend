<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customizedArts(){
        return $this->hasMany(CustomizedArt::class);
    }
}
