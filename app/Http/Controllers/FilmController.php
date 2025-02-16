<?php

namespace App\Http\Controllers;
use App\Models\Screening;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the films with optional filters.
     */
    public function index(Request $request)
    {
        // Query for films with optional filters
        $query = Film::query();

        // Filter by genre if provided
        if ($request->filled('genre') && $request->genre !== 'all') {
            $query->where('category', $request->genre);
        }

        // Filter by date if provided
        if ($request->filled('date')) {
            // Assuming created_at stores the film's creation or screening date
            $query->whereDate('created_at', $request->date);
        }

        // Retrieve the filtered list of films
        $films = $query->get();

        // Return the index view with the list of films
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new film.
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Store a newly created film in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validate image
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Save the uploaded image in the public/images directory
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
    
            // Save only the file name in the database
            $validated['image'] = $imageName;
        } else {
            // If no image is uploaded, set the image field to null
            $validated['image'] = null;
        }
    
        // Create the film record
        Film::create($validated);
    
        return redirect()->route('films.index')->with('success', 'Film został pomyślnie utworzony.');
    }

    


        /**
     * Show the form for editing an existing film.
     */
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    /**
     * Update an existing film in storage.
     */
    public function update(Request $request, Film $film)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($film->image && file_exists(public_path('images/' . $film->image))) {
                unlink(public_path('images/' . $film->image));
            }
    
            // Save the new image in the public/images directory
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
    
            // Update the image path in the database
            $validated['image'] = $imageName;
        }
    
        // Update the film record
        $film->update($validated);
    
        return redirect()->route('films.index')->with('success', 'Film updated successfully.');
    }
    
    /**
     * Remove the specified film from storage.
     */
    public function destroy(Film $film)
    {
        if ($film->image) {
            \Storage::disk('public')->delete($film->image); // Remove the image file
        }
    
        $film->delete();
    
        return redirect()->route('films.index')->with('success', 'Film deleted successfully.');
        
    }
    public function show($id)

    {
    $film = Film::findOrFail($id); // Fetch the film by ID
    $screenings = Screening::where('film_id', $id)->get(); // Fetch related screenings

    return view('films.show', compact('film', 'screenings'));
}

}
