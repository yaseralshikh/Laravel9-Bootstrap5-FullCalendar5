<?php

namespace App\Http\Controllers;

use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        return  Event::with('user:id,name')->where('user_id',auth()->user()->id)->with('week:id,title')->with('semester:id,title,school_year')->with('office:id,name')
            ->Where('office_id', auth()->user()->office_id)->get();
    }
}
