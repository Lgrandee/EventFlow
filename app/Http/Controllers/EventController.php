<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['category', 'creator']);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        return view('AdminDashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'start_time' => 'required',
            'location' => 'required|max:255',
            'max_attendees' => 'required|integer|min:1',
        ]);

        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
        ]);

        return redirect()
            ->route('EventAdminController')
            ->with('success', 'Event succesvol aangemaakt!');
    }

    public function register(Event $event)
    {
        if ($event->registrations()->count() >= $event->max_attendees) {
            return back()->with('error', 'Dit evenement is volgeboekt.');
        }

        $event->registrations()->create([
            'user_id' => Auth::user()->id(),
            'event_id' => $event->id,
        ]);

        return back()->with('success', 'Je bent succesvol ingeschreven!');
    }

    public function adminIndex()
    {
        $events = Event::all();

        return view('AdminDashboard.event', compact('events'));
    }

    public function adminShow(Event $event)
    {
        return view('AdminDashboard.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('AdminDashboard.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'max_attendees' => 'required|integer|min:1',
        ]);

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
        ]);

        return redirect()
            ->route('AdminController.show', ['event' => $event->id])
            ->with('success', 'Event bijgewerkt!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('EventAdminController')
            ->with('success', 'Event verwijderd!');
    }
}