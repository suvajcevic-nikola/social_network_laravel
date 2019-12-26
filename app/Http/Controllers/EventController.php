<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index($id)
    {
        $event = Event::findOrFail($id);
        return view("event", ['event' => $event]);
    }

}
