<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['category', 'creator', 'registrations'])->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['category', 'creator', 'registrations']);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('AdminDashboard.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
        ]);

        // Using query() explicitly tells Intelephense this is an Eloquent builder instance
        Event::query()->create($data);

        return to_route('admin.events')
            ->with('success', 'Event aangemaakt');
    }

    public function register(Event $event)
    {
        $userId = Auth::id();

        // 1. Controleer of de gebruiker al is ingeschreven
        if (Registration::query()->where('event_id', $event->id)
            ->where('user_id', $userId)
            ->exists()) {
            // Als ze al ingeschreven zijn, sturen we ze naar het dashboard met een melding
            return to_route('userevent')->with('error', 'Je bent al ingeschreven voor dit evenement.');
        }

        // 2. Controleer of het evenement vol zit
        if ($event->registrations()->count() >= $event->max_attendees) {
            return to_route('events.index')->with('error', 'Inschrijven mislukt: Dit evenement is vol.');
        }

        // 3. Sla de inschrijving op
        Registration::query()->create([
            'user_id' => $userId,
            'event_id' => $event->id,
            'registrated_at' => now(),
        ]);

        // HIER GEBEURT HET: Stuur de gebruiker direct door naar de hoofdpagina met een succesmelding
        return to_route('events.index')->with('success', 'Je bent succesvol ingeschreven voor '.$event->name.'!');
    }

    public function userEvents()
    {
        // Haal alle ingeschreven evenementen op via de registraties van de gebruiker
        $allEvents = Auth::user()
            ->registrations()
            ->with('event.category') // Direct ook de categorie inladen
            ->get()
            ->map(fn ($r) => $r->event);

        // Splits de evenementen op in aankomend en afgelopen
        $upcomingEvents = $allEvents->filter(function ($event) {
            return \Carbon\Carbon::parse($event->start_time)->isFuture();
        });

        $pastEvents = $allEvents->filter(function ($event) {
            return \Carbon\Carbon::parse($event->start_time)->isPast();
        });

        // Geef beide lijstjes door naar de view
        return view('UserDashboard.userevent', compact('upcomingEvents', 'pastEvents'));
    }

    public function adminIndex()
    {
        $events = Event::with(['category', 'creator', 'registrations'])->get();

        return view('AdminDashboard.event', compact('events'));
    }

    public function adminShow(Event $event)
    {
        $event->load(['category', 'creator', 'registrations']);

        return view('AdminDashboard.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = Category::all();

        return view('AdminDashboard.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
        ]));

        // Using to_route() prevents method chaining syntax errors in your IDE
        return to_route('admin.events.show', $event)
            ->with('success', 'Event bijgewerkt');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return to_route('admin.events')
            ->with('success', 'Event verwijderd');
    }

    public function confirm(Event $event)
    {
        $event->load(['category', 'creator', 'registrations']);

        return view('events.confirm', compact('event'));
    }
}
