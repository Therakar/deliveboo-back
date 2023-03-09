<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Kitchen;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!Auth::user()->restaurant) {
        //     return redirect()->route('admin.restaurants.create');
        // }
        // return view('admin.restaurants.index');
        $url = url()->previous();
        return redirect($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        if (Auth::user()->restaurant) {
            $url = url()->previous();
            return redirect($url);
        }
        $kitchens = Kitchen::all();
        return view('admin.restaurants.create', compact('kitchens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        $userId = Auth::id();

        $data = $request->validated();

        $new_restaurant = new Restaurant();

        $new_restaurant->user_id = $userId;

        $new_restaurant->fill($data);

        $new_restaurant->slug = Str::slug($new_restaurant->name . '-' . $new_restaurant->city . '-' . $new_restaurant->postal_code);

        //upload immagini
        if (isset($data['image'])) {
            //salvo il path dell'immagine a db
            $new_restaurant->image = Storage::disk('public')->put('uploads', $data['image']);
        };

        $new_restaurant->save();

        $new_restaurant->kitchens()->sync($data['kitchens']);

        return redirect()->route('admin.restaurants.show', $new_restaurant)->with('message', "Il ristorante \"$new_restaurant->name\" è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if (!Auth::user()->restaurant) {
            return redirect()->route('admin.restaurants.create');
        } elseif (Auth::user()->restaurant != $restaurant) {
            $url = url()->previous();
            return redirect($url)->with('warning', "La pagina non è accessibile, sei stato reindirizzato alla pagina precedente!");
        }
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $user = Auth::id();
        $url = url()->previous();
        if ($restaurant->user_id != $user) {
            return redirect($url)->with('warning', "La pagina non è accessibile, sei stato reindirizzato alla pagina precedente!");
        }

        $kitchens = Kitchen::all();

        return view('admin.restaurants.edit', compact('restaurant', 'kitchens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();

        $old_name = $restaurant->name;

        $restaurant->slug = Str::slug($data['name'] . '-' . $data['city'] . '-' . $data['postal_code']);

        if (isset($data['image'])) {
            // controllo che verifica se è presente l'immagine e la cancella di default se già inserita
            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }
            $data['image'] = Storage::disk('public')->put('uploads', $data['image']);
        }

        // controllo che verifica se viene settata la checkbox per NON caricare alcuna immagine in fase di modifica del ristorante
        if (isset($data['no_image']) && $restaurant->image) {
            Storage::disk('public')->delete($restaurant->image);
            $restaurant_placeholder = Restaurant::$restaurantPlaceholderUrl;
            $restaurant->image = $restaurant_placeholder;
        }

        $restaurant->update($data);

        if (isset($data['kitchens'])) {
            $restaurant->kitchens()->sync($data['kitchens']);
        } else {
            $restaurant->kitchens()->sync([]);
        }

        return redirect()->route('admin.restaurants.show', $restaurant)->with('message', "Il ristorante \"$old_name\" è stato aggiornato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $old_name = $restaurant->name;

        // if ($restaurant->image) {
        //     Storage::disk('public')->delete($restaurant->image);
        // }

        $restaurant->delete();

        return redirect()->route('admin.restaurants.create')->with('message', "Il ristorante \"$old_name\" è stato cancellato!");
    }
}
