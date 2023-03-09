<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('products', 'kitchens')->get();

        return $restaurants;
    }

    public function show($slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)->with('products', 'kitchens')->firstOrFail();
            return $restaurant;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => '404 Restaurant not found'
            ], 404);
        }
    }
}
