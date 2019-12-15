<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Image;
use App\Models\Translation;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\File;

//For Mail
use App\Mail\ApartmentEmail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ApartmentsController extends Controller
{

    public function index(){

        return Apartments::with('prices', 'images')->get();

    }
    public function store(request $request){

        $apartment= Apartments::create([
            'name' => $request['name'],
            ]);

        if ($request->hasfile('images')) {
            $images = $request->file('images');
            File::makeDirectory(base_path().'/public/uploads/' .$apartment->id, $mode = 0777, true, true);
            foreach ($images as $image) {
                $imagename = now()->timestamp . "_" . $image->getClientOriginalName();
                $path = base_path().'/public/uploads/';
                Image::create([
                    'apartments_id' => $apartment->id,
                    'path' => $imagename,
                ]);
                $image->move($path .$apartment->id , $imagename);
            }
        }
        Translation::create([
            'description' => $request['description'],
            'details' => $request['details'],
            'language' => 'cro',
            'apartments_id'=>$apartment->id,

        ]);

        Translation::create(['description' => 'Unesite podatke', 'details' => 'Unesite podatke', 'language' => 'en', 'apartments_id'=>$apartment->id]);
        Translation::create(['description' => 'Unesite podatke', 'details' => 'Unesite podatke', 'language' => 'de', 'apartments_id'=>$apartment->id]);
        $apartment->images;

        return $apartment;
    }

    public function show(Apartments $apartment)
    {
        return Apartments::with('prices', 'images', 'calendar', 'translation')->findOrFail($apartment->id);
    }

    public function update(Request $request, Apartments $apartment)
    {

        $apartment->update(request([
                'name',
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
                $image->move(base_path().'/public/uploads/' . $apartment->id, $imagename);
            }
        }

        Translation::whereId($request['translations_id'])->update([
            'description' => $request['description'],
            'details' => $request['details'],
        ]);

        $apartment->images;

        return $apartment;
    }
    public function destroy(Apartments $apartment)
    {

        $apartment->delete();
        return response('Success', 200);
    }

    public function email(Request $request){


        $data = $this->validate($request, [
            'apartmentName' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        Mail::to('mladen1101@gmail.com', 'Villa Promajna')->send( new ApartmentEmail($data));
        return response('Success', 200);

    }
}
