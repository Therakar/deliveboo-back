<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recupera il ristorante dell'utente loggato
        $restaurant = Auth::user()->restaurant;

        // Recupera gli ordini che hanno almeno un prodotto appartenente al ristorante dell'utente loggato
        $orders = Order::whereHas('products', function ($query) use ($restaurant) {
            // Imposta una clausola where sulla colonna 'restaurant_id' del prodotto
            // confrontandola con l'id del ristorante dell'utente loggato
            $query->where('restaurant_id', $restaurant->id);
        })
            // Ordina gli ordini per data di creazione e per id in ordine decrescente
            ->orderByDesc('created_at')->orderByDesc('id')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $order = new Order();
        $order->fill($data);
        $order->created_at = now();
        $deliveryDate = session()->get('delivery_date');
        if (!$deliveryDate) {
            $deliveryDate = now()->addMinutes(rand(30, 60));
            session()->put('delivery_date', $deliveryDate);
        }
        $order->delivery_date = $deliveryDate;
        $order->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // $user = Auth::id();
        // $url = url()->previous();
        // if ($order->user_id != $user) {
        // return redirect($url);
        // }
        // Recupera il ristorante dell'utente loggato
        $restaurant = Auth::user()->restaurant;

        // Verifica che l'ordine appartenga al ristorante dell'utente loggato
        if ($order->products->where('restaurant_id', $restaurant->id)->isEmpty()) {
            // Se l'ordine non appartiene al ristorante dell'utente loggato, reindirizza all'URL precedente
            $url = url()->previous();
            return redirect($url)->with('warning', "La pagina non è accessibile, sei stato reindirizzato alla pagina precedente!");
        }

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
