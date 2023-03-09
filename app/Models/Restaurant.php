<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['user_id'];
    protected $appends = ['image_url'];
    public static $restaurantPlaceholderUrl = "https://www.ilborghista.it/immaginiutente/attivita_foto/300_m_32915-ath0q9p5q6b3m7b3b8p7x9k3x4v9q4k5b5w3l1z1d6k5q1g6p3k7.jpg?a=9192";

    // metodo per aggiungere una proprietà al model se non abbiamo una colonna a database con l'obiettivo di restituire l'url completo dell'immagine
    protected function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, "uploads")) {
            return asset("storage/$this->image");
        } else {
            return self::$restaurantPlaceholderUrl;
        }
    }

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
