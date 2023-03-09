<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];

    // metodo per aggiungere una proprietà al model se non abbiamo una colonna a database con l'obiettivo di restituire l'url completo dell'immagine
    protected function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, "uploads")) {
            return asset("storage/$this->image");
        }
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_product', 'product_id', 'order_id')->withPivot('quantity');
    }
}
