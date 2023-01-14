<?php

namespace App\Http\Controllers;

use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        return Event::with('user:id,name')->with('week.semester:id,title,school_year')->get();
    }
}
