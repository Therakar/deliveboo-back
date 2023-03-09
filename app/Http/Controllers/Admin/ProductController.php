<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant, Product $product)
    {

        $userId = Auth::id();
        if (!Auth::user()->restaurant) {
            $url = url()->previous();
            return redirect($url);
        }
        $restaurant = Restaurant::where('user_id', $userId)->first();
        $products = Product::where('restaurant_id', $restaurant->id)->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $products = Product::all();
        $typologies = DB::table('products')->select('typology')->distinct()->get();
        return view('admin.products.create', compact('products', 'typologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $userId = Auth::id();

        $restaurant = Restaurant::where('user_id', $userId)->first();

        $data = $request->validated();

        $new_product = new Product();

        $new_product->restaurant_id = $restaurant->id;

        $new_product->fill($data);

        //upload immagini
        if (isset($data['image'])) {

            //salvo il path dell'immagine a db
            $new_product->image = Storage::disk('public')->put('uploads', $data['image']);
        };

        $new_product->save();

        return redirect()->route('admin.products.show', $new_product)->with('message', "Il prodotto \"$new_product->name\" è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = Auth::id();
        $url = url()->previous();
        if ($product->restaurant->user_id != $user) {
            return redirect($url)->with('warning', "La pagina non è accessibile, sei stato reindirizzato alla pagina precedente!");
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = Auth::id();
        $url = url()->previous();
        if ($product->restaurant->user_id != $user) {
            return redirect($url)->with('warning', "La pagina non è accessibile, sei stato reindirizzato alla pagina precedente!");
        }
        $typologies = DB::table('products')->select('typology')->distinct()->get();
        return view('admin.products.edit', compact('product', 'typologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $old_name = $product->name;

        if (isset($data['image'])) {
            // controllo che verifica se è presente l'immagine e la cancella di default se già inserita
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = Storage::disk('public')->put('uploads', $data['image']);
        }

        // controllo che verifica se viene settata la checkbox per NON caricare alcuna immagine in fase di modifica del progetto
        if (isset($data['no_image']) && $product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->update($data);

        return redirect()->route('admin.products.show', compact('product'))->with('message', "Il prodotto \"$old_name\" è stato aggiornato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $old_name = $product->name;

        // if ($product->image) {
        //     Storage::disk('public')->delete($product->image);
        // }

        $product->delete();

        return redirect()->route('admin.products.index')->with('message', "Il prodotto \"$old_name\" è stato cancellato!");
    }
}
