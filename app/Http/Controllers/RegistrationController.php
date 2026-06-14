<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function destroy(Event $event)
    {
        // Alleen de ingelogde gebruiker mag zijn/haar eigen inschrijving verwijderen.
        $deleted = Auth::user()
            ->registrations()
            ->where('event_id', $event->id)
            ->delete();

        return back()->with(
            'success',
            $deleted ? 'Uitgeschreven.' : 'Je was niet ingeschreven voor dit evenement.'
        );
    }
}

