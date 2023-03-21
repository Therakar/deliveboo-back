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
            [
                'name' => 'Eleven Madison Park',
                'address' => 'Via Roma 68',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-mOId9XpSPCugmL73ijCwy6ktR0ltGPjmyw&usqp=CAU',
            ],
            [
                'name' => 'Mugaritz',
                'address' => 'Via delle Orfane 12',
                'image' => 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?cs=srgb&dl=pexels-ella-olsson-1640777.jpg&fm=jpg',
            ],
            [
                'name' => 'Attica',
                'address' => 'Via Montenapoleone 4',
                'image' => 'https://images.immediate.co.uk/production/volatile/sites/30/2022/06/Top-10-foods-to-try-in-Mexico-c560a97.jpg',
            ],
            [
                'name' => 'Boragó',
                'address' => 'Via San Gregorio Armeno 23',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHTvbvEej9hVIAvF8WMl1N_UC244wvRRjKVw&usqp=CAU',
            ],
            [
                'name' => 'Le Bernadin',
                'address' => 'Via Garibaldi 56',
                'image' => 'https://media.istockphoto.com/id/1220017909/photo/top-view-table-full-of-food.jpg?s=170667a&w=0&k=20&c=aqS9rBQtGzmcOP4ddNKYTU7h8gyG3Y3KVhsh1hlQd-g=',
            ],
            [
                'name' => 'Osteria Mozza',
                'address' => 'Corso Vittorio Emanuele II 21',
                'image' => 'https://cdn.domestika.org/c_fit,dpr_auto,f_auto,t_base_params,w_820/v1628688403/content-items/008/769/650/03.food-stylist-favoritos-alfonso-acedo-instagram-original-original-original.jpg?1628688403',
            ],
            [
                'name' => 'Eleven Madison Park',
                'address' => 'Via dei Calzaiuoli 1',
                'image' => 'https://media1.popsugar-assets.com/files/thumbor/jAQJl4-7gc8P3M--mfUIZQE3RY8/fit-in/2048xorig/filters:format_auto-!!-:strip_icc-!!-/2019/03/11/873/n/44498184/830f2f0b5c86bdb5f0dd05.93587763_/i/Best-Baking-Instagram-Accounts-Follow.jpg',
            ],
            [
                'name' => 'Le Bernadin',
                'address' => 'Via Condotti 34',
                'image' => 'https://www.eatright.org/-/media/images/eatright-articles/eatright-article-thumbnails/globalfoodsforahealthyplate_600x450.jpg?h=450&w=600&hash=23321A2B5BD82F4C21C0F878F6057565',
            ],
            [
                'name' => 'Il Gallo d\'oro',
                'address' => 'Via Po 7',
                'image' => 'https://www.healthifyme.com/blog/wp-content/uploads/2023/01/shutterstock_1478169152-1.jpg',
            ],
            [
                'name' => 'Sushi Niwa',
                'address' => 'Corso Umberto I 89',
                'image' => 'https://hips.hearstapps.com/hmg-prod/images/gettyimages-1134086327.png?resize=1200:*',
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
