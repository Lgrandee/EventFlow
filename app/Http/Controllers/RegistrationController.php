<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function destroy(Event $event)
    {
        // Adding query() fixes the false-positive argument error in your IDE
        Registration::query()->where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Uitgeschreven.');
    }
}