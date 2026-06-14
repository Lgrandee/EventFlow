<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $folder = Auth::user()->role === 'Organizer' ? 'OrganizerDashboard' : 'AdminDashboard';
        return view($folder . '.categories', ['categories' => Category::all()]);
    }

    public function create()
    {
        $folder = Auth::user()->role === 'Organizer' ? 'OrganizerDashboard' : 'AdminDashboard';
        // Zorg dat het bestand echt 'categoriescreate.blade.php' heet in die map
        return view($folder . '.categoriescreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:255|unique:categories,name']);
        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Aangemaakt!');
    }

    public function destroy(Category $category)
    {
        if ($category->events()->count() > 0) {
            return back()->with('error', 'Deze categorie is nog in gebruik.');
        }
        $category->delete();
        return back()->with('success', 'Verwijderd.');
    }
}