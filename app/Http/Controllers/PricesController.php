<?php

namespace App\Http\Controllers;
use App\Models\Prices;
use Illuminate\Http\Request;

class PricesController extends Controller
{

    public function index(){

        return Prices::all();

    }

    public function store(request $request){

        $price= Prices::create([
            'date_start' => $request['start'],
            'date_end' => $request['end'],
            'price' => $request['price'],
            'apartments_id' => $request['apartments_id']
        ]);
        return $price;
    }

    public function show(Apartment $apartment)
    {
        return Prices::with('apartments')->findOrFail($apartment->id);
    }

    public function destroy(Prices $price)
    {
        $price->delete();
        return response('Success', 200);
    }
}
