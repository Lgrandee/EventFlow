<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event = $event->load(['category', 'creator']);
        return view('events.show', compact('event'));
    }
}
