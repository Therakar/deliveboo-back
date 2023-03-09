<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        Order::truncate();
        Schema::enableForeignKeyConstraints();
    
        
        for($i=0; $i<8; $i++){
        $new_order= new Order();
        $new_order->name_customer=$faker->name();
        $new_order->address_customer = $faker->address();
        $new_order->email_customer=$faker->email();
        $new_order->phone_number=$faker->phoneNumber();
        // $new_order->delivery_date = $faker->dateTime();
        // $new_order->creation_date = $faker->dateTime();
        $new_order->total_price = $faker->numerify('###.##');
        $new_order->save();
       }
    }
}
