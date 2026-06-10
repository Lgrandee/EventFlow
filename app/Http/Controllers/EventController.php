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

    public function store(Event $event)
    {
        $user = auth('web')->user();

        // Registratie opslaan in registrations table
        $event->registrations()->create([
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Je bent succesvol ingeschreven!');
    }

    public function register(Event $event)
    {
        $user = auth('web')->user();

        // Registratie opslaan in registrations table
        $event->registrations()->create([
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Je bent ingeschreven!');
    }
}
