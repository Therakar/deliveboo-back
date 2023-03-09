<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Metodo truncate() per ripopolare da zero il seeder (Restaurant in questo caso) ogni volta che viene rilanciato
        Schema::disableForeignKeyConstraints();
        Restaurant::truncate();
        Schema::enableForeignKeyConstraints();

        $restaurants = [
            [
                'name' => 'La Pergola',
                'address' => 'Via Alberto Cadlolo 101',
                'image' => 'https://www.projectinvictus.it/wp-content/uploads/2022/08/junk-food-scaled.jpg',
            ],
            [
                'name' => 'Sora Lella',
                'address' => 'Piazza delle Vaschette 13',
                'image' => 'https://www.yegam.it/wp-content/uploads/2019/05/yegam-blog-slow-food.jpg',
            ],
            [
                'name' => 'Osteria Francescana',
                'address' => 'Via Stella 22',
                'image' => 'https://ichef.bbci.co.uk//food/ic/food_16x9_832/recipes/crispy_smashed_potatoes_70636_16x9.jpg',
            ],
            [
                'name' => 'Le Calandre',
                'address' => 'Via Liguria 1',
                'image' => 'https://tb-static.uber.com/prod/image-proc/processed_images/91e744b222ecac52cfaf1f15cd79eadc/69ad85cd7b39888042b3bbf1c22d630d.webp',
            ],
            [
                'name' => 'Il Ristorante del Borgo',
                'address' => 'Via Cattolica Eraclea 9',
                'image' => 'https://www.fabriziocostantini.it/images/food-digital.jpg',
            ],
            [
                'name' => 'La Trattoria da Gino',
                'address' => 'Via Santa Giulia 10',
                'image' => 'https://www.torinotoday.it/~media/horizontal-hi/50984033489356/cibo_osteria_pexels-2.jpg',
            ],
            [
                'name' => 'La Taverna del Vecchio Mulino',
                'address' => 'Via San Rocco 9',
                'image' => 'https://media.suara.com/pictures/653x366/2021/08/02/81387-ilustrasi-makanan-cepat-saji-freepik.jpg',
            ],
            [
                'name' => 'La Pizzeria del Corso',
                'address' => 'Via Roma 18',
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1b/59/24/ba/pizza.jpg',
            ],
            [
                'name' => 'La Locanda della Luna',
                'address' => 'Via Palazzetta 9',
                'image' => 'https://media.gqitalia.it/photos/60105cb52ff22977eb9ae86e/16:9/w_1280,c_limit/Ritorno%20dei%20Climatariani_Pinterest%20(sustainablefood).jpg',
            ],
            [
                'name' => 'Sapori d\'Oriente',
                'address' => 'Via Appia Nuova 123',
                'image' => 'http://static1.squarespace.com/static/53b839afe4b07ea978436183/53bbeeb2e4b095b6a428a13e/5fd2570b51740e23cce97919/1676678395594/traditional-food-around-the-world-Travlinmad.jpg?format=1500w',
            ],
        ];
        

        foreach (User::all() as $key => $user) {
            $new_restaurant = new Restaurant();
            $restaurant_data = $restaurants[$key % count($restaurants)];
            $new_restaurant->name = $restaurant_data['name'];
            $new_restaurant->city = $faker->state();
            $new_restaurant->street_address = $restaurant_data['address'];
            $new_restaurant->postal_code = $faker->postcode();
            $new_restaurant->vat_number = $faker->numerify('###########');
            $new_restaurant->image = $restaurant_data['image'];
            $new_restaurant->user_id = $user->id;
            $new_restaurant->slug = Str::slug($new_restaurant->name . '-' . $new_restaurant->city . '-' . $new_restaurant->postal_code);
            $new_restaurant->save();
        }
    }
}
