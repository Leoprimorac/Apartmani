<?php

namespace App\Http\Controllers;
use App\Models\Apartments;
use App\Models\Image;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{

    public function index(){

        return Apartments::with('prices', 'images')->get();

    }
    public function store(request $request){

        $apartment= Apartments::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'details' => $request['details'],
            'amenities' => $request['amenities']
        ]);

        if ($request->hasfile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imagename = now()->timestamp . "_" . $image->getClientOriginalName();
                Image::create([
                    'apartments_id' => $apartment->id,
                    'path' => $imagename,
                ]);
                $image->move('uploads/' . $apartment->id, $imagename);
            }
        }

        $apartment->images;

        return $apartment;
    }

    public function show(Apartments $apartment)
    {
        return Apartments::with('prices', 'images', 'calendar')->findOrFail($apartment->id);
    }

    public function update(Request $request, Apartments $apartment)
    {

        $apartment->update(request([
                'name',
                'description',
                'details',
                'amenities'
            ])
        );


        if ($request->hasfile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imagename = now()->timestamp . "_" . $image->getClientOriginalName();
                Image::create([
                    'apartments_id' => $request->id,
                    'path' => $imagename,
                ]);
                $image->move('uploads/' . $apartment->id, $imagename);
            }
        }

        $apartment->images;

        return $apartment;
    }
    public function destroy(Apartments $apartment)
    {
        $apartment->delete();
        return response('Success', 200);
    }
}
