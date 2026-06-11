<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function authenticated(Request $request, $user)
    {
        return match ($user->role) {
            'admin' => redirect()->route('AdminDashboard'),
            'organizer' => redirect()->route('OrganizerDashboard'),
            'user' => redirect()->route('UserDashboard'),
            default => redirect()->route('home'),
        };
    }

    public function AdminDashboard()
    {
        return view('dashboards.admin');
    }

    public function OrganizerDashboard()
    {
        return view('dashboards.organizer');
    }

    public function ParticipantDashboard()
    {
        return view('dashboards.participant');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function dashboardRedirect(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        return $this->authenticated($request, $user);
    }
}
