<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with([
            'category',
            'creator',
            'registrations',
        ])->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['category', 'creator']);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('AdminDashboard.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
        ]);

        Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_time' => $validated['start_time'],
            'location' => $validated['location'],
            'category_id' => $validated['category_id'],
            'max_attendees' => $validated['max_attendees'],
        ]);

        return redirect()
            ->route('EventAdminController')
            ->with('success', 'Event succesvol aangemaakt!');
    }

    public function register(Event $event)
    {
        // Controleer of de gebruiker al is aangemeld
        if ($event->registrations()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'Je bent al aangemeld voor dit evenement.');
        }

        // Controleer of het evenement vol is
        if ($event->registrations()->count() >= $event->max_attendees) {
            return back()->with('error', 'Dit evenement is volgeboekt.');
        }

        // Maak de registratie aan
        $event->registrations()->create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'registrated_at' => now(),
        ]);

        return back()->with('success', 'Je bent succesvol aangemeld!');
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
        ]);

        $event->update($validated);

        return redirect()
            ->route('AdminController.show', $event)
            ->with('success', 'Event bijgewerkt.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('EventAdminController')
            ->with('success', 'Event verwijderd!');
    }

    public function confirm(Event $event)
    {
        $event->load('registrations');

        return view('events.confirm', compact('event'));
    }

    public function userEvents()
    {
        // Haal de evenementen van de ingelogde gebruiker op via de relatie
        $events = Auth::user()->events ?? collect();

        // Stuur de data door naar de juiste Blade view
        return view('UserDashboard.userevent', compact('events'));
    }
}
