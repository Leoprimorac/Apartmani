<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show(Calendar $calendar)
    {
        return Calendar::findOrFail($calendar->id);
    }
    public function store(request $request){

        $calendar= Calendar::create([
            'apartments_id' => $request['apartments_id'],
            'date_start' => $request['date_start'],
            'date_end' => $request['date_end'],
            'availability' => $request['availability']
        ]);

        return $calendar;
    }
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response('Success', 200);
    }


}
