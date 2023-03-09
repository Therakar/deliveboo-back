<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $guarded= ['user_id'];

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class);
    }
}
