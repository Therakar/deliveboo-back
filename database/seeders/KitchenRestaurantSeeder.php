<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KitchenRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('kitchen_restaurant')->truncate();
        Schema::enableForeignKeyConstraints();

        $restaurants = Restaurant::all();
        $kitchens = Kitchen::all();

        foreach ($restaurants as $restaurant) {
            // scegliere un numero casuale di cucine tra 1 e 3
            $count = rand(1, 3);

            // creare un array di indici casuale delle cucine
            $kitchenIds = $kitchens->pluck('id')->shuffle()->take($count);

            // associare le cucine al ristorante
            $restaurant->kitchens()->sync($kitchenIds);
        }
        
    }
}
