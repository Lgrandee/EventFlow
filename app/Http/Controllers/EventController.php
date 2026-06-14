<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    private function getDashboardFolder(): string
    {
        return Auth::check() && Auth::user()->role === 'Organizer'
            ? 'OrganizerDashboard'
            : 'AdminDashboard';
    }

    public function index()
    {
        return view('events.index', [
            'events' => Event::all(),
        ]);
    }

    public function adminIndex()
    {
        if (Auth::user()->role !== 'Admin') return redirect('/');
        return view('AdminDashboard.index', ['events' => Event::all()]);
    }

    public function organizerIndex()
    {
        if (Auth::user()->role !== 'Organizer') return redirect('/');
        return view('OrganizerDashboard.index', ['events' => Event::all()]);
    }

    public function create()
    {
        return view($this->getDashboardFolder() . '.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'max_tickets' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        Event::create([
            'name' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'start_time' => $validated['date'],
            'max_attendees' => $validated['max_tickets'],
            'category_id' => $validated['category_id'],
            'created_by' => Auth::id(),
        ]);

        $routeName = Auth::user()->role === 'Organizer' ? 'OrganizerDashboard' : 'admin.events';
        return redirect()->route($routeName)->with('success', 'Evenement aangemaakt!');
    }

    public function userEvents()
    {
        $user = Auth::user();
        $registeredEvents = $user ? $user->registrations()->with('event')->get()->pluck('event')->filter() : collect();

        // This path must match: resources/views/events/my-events.blade.php
        return view('events.my-events', [
            'events' => $registeredEvents,
        ]);
    }

    public function show(Event $event)
    {
        $event->load(['category', 'registrations.user']);
        return view('events.show', ['event' => $event]);
    }

    // ... (rest of your methods: update, destroy, confirm, register remain the same)
}