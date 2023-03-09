<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Routing\Route;


class OrderController extends Controller
{
    public function store(Request $request){
        $data = $request->all(); // ricevi i dati inviati dal frontend

        $new_order = new Order();
        $new_order-> name_customer= $data['name_customer'];
        $new_order-> total_price= $data['total_price'];
        $new_order-> email_customer= $data['email_customer'];
        $new_order-> phone_number= $data['phone_number'];
        $new_order-> address_customer= $data['address_customer'];
        $new_order->save();

        foreach($data['order'] as $element){
            $new_order->products()->attach($element['product_id'],[
                'quantity'=>$element['quantity']
            ]);
        }

        return response()->json(['message' => 'Ordine creato con successo.']);
    }
}
