<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Metodo truncate() per ripopolare da zero il seeder (Kitchen in questo caso) ogni volta che viene rilanciato
        Schema::disableForeignKeyConstraints();
        Kitchen::truncate();
        Schema::enableForeignKeyConstraints();

        $kitchens = ['italiano', 'internazionale', 'cinese', 'giapponese', 'messicano', 'indiano', 'coreano', 'francese', 'thailandese', 'australiano'];

        for ($i = 0; $i < count($kitchens); $i++) {
            $new_kitchen = new Kitchen();
            $new_kitchen->name = $kitchens[$i];
            $new_kitchen->save();
        }
    }
}
