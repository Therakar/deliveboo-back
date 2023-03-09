<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_product', 'order_id', 'product_id')->withPivot('quantity');
    }

    // salva ogni nuova istanza di order creando una data di consegna randomica 
    public function save(array $options = [])
    {
        if (!$this->delivery_date) {
            // genero data di consegna partendo dalla data di creazione ordine aggiungendo un numero di minuti random compreso tra 30 e 60 minuti
            $deliveryDate = Carbon::parse($this->created_at)->addMinutes(rand(30, 60));
            $this->delivery_date = $deliveryDate;
        }
        parent::save($options);
    }
}
