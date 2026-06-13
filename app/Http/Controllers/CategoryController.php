<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Overzicht van alle bestaande categorieën
    public function index()
    {
        $categories = Category::query()->withCount('events')->get();
        return view('AdminDashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('AdminDashboard.categories.create');
    }

    // Nieuwe categorie toevoegen
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        Category::query()->create($data);

        return to_route('admin.categories.index')
            ->with('success', 'Categorie succesvol aangemaakt!');
    }

    // Categorie veilig verwijderen (indien ongebruikt)
    public function destroy(Category $category)
    {
        if ($category->events()->exists()) {
            return back()->with('error', 'Deze categorie kan niet worden verwijderd omdat er nog evenementen aan gekoppeld zijn!');
        }

        // Door de specifieke instantie te verwijderen verdwijnt de "Not enough arguments" melding
        $category->delete();

        return to_route('admin.categories.index')
            ->with('success', 'Categorie succesvol verwijderd.');
    }
}