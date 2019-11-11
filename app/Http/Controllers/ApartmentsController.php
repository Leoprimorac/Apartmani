<?php

namespace App\Http\Controllers;
use App\Models\Apartments;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{

    public function index(){

        return Apartments::all();

    }
    public function store(request $request){

        $apartment= Apartments::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'details' => $request['details'],
            'amenities' => $request['amenities']
        ]);
    }

    public function show(Apartments $apartment)
    {
        return Apartments::findOrFail($apartment->id);
    }
}
